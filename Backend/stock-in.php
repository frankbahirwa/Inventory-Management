<?php
session_start();
require 'connection.php';

$action = 'stockIn';

$name = trim($_POST['name']);
$description = trim($_POST['description']);
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$supplier = trim($_POST['supplier']);
$category = trim($_POST['category']);
$product_image_path = 'none';

$errors = [];

// Validation checks
if (empty($name)) {
    $errors[] = "Product name is required.";
}
if (empty($description)) {
    $errors[] = "Description is required.";
}
if (!is_numeric($price) || $price <= 0) {
    $errors[] = "Price should be a positive number.";
}
if (!is_numeric($quantity) || $quantity <= 0) {
    $errors[] = "Quantity should be a positive integer.";
}
if (empty($supplier)) {
    $errors[] = "Supplier is required.";
}
if (empty($category)) {
    $errors[] = "Category is required.";
}

// Image upload logic
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $image = $_FILES['image'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $imageExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $maxFileSize = 5 * 1024 * 1024;

    if (!in_array($imageExtension, $allowedExtensions)) {
        $errors[] = "Only image files (JPG, JPEG, PNG, GIF) are allowed.";
    }
    if ($image['size'] > $maxFileSize) {
        $errors[] = "Image size should not exceed 5MB.";
    }

    if (empty($errors)) {
        $uniqueFileName = uniqid() . '.' . $imageExtension;
        $product_image_path = '../assets/products/' . $uniqueFileName;

        if (!move_uploaded_file($image['tmp_name'], $product_image_path)) {
            $errors[] = "Failed to upload the image.";
            $product_image_path = 'none';
        }
    }
}

// Error display
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<script>alert('$error');window.history.back();</script>";
    }
    exit;
}

// Get user ID
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT user_id FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<script>alert('User not found.');window.history.back();</script>";
    exit;
}

$added_by = $user['user_id'];


$stmt = $conn->prepare("SELECT product_id FROM products WHERE product_name = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product_id = $row['product_id'];
}


if ($action === 'stockIn') {
    $stmt = $conn->prepare("SELECT quantity, product_image_path FROM products WHERE product_name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;

        if ($product_image_path !== 'none') {
            $stmt = $conn->prepare("UPDATE products SET quantity = ?, product_image_path = ?, price = ?, updated_at = NOW() WHERE product_name = ?");
            $stmt->bind_param("idss", $new_quantity, $product_image_path, $price, $name);
        } else {
            $stmt = $conn->prepare("UPDATE products SET quantity = ?, price = ?, updated_at = NOW() WHERE product_name = ?");
            $stmt->bind_param("ids", $new_quantity, $price, $name);
        }
        $stmt->execute();

    } else {
        $stmt = $conn->prepare("INSERT INTO products (product_name, description, price, quantity, supplier, category, product_image_path, added_by, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("ssdiissi", $name, $description, $price, $quantity, $supplier, $category, $product_image_path, $added_by);
        $stmt->execute();
    }

    $stockInStmt = $conn->prepare("INSERT INTO stockin (product_name, description, price, product_id, quantity, supplier, category, product_image_path, added_by, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stockInStmt->bind_param("ssdiiissi", $name, $description, $price, $product_id, $quantity, $supplier, $category, $product_image_path, $added_by);
    $stockInStmt->execute();

    echo "<script>alert('Stock-in recorded successfully.'); window.location.href = '../pages/dashboard.php';</script>";
    exit;
}

$conn->close();
?>