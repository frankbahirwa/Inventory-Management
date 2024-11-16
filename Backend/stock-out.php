<?php
session_start();
require "connection.php";

$action = 'stockOut';
$name = trim($_POST['name']);
$quantity = trim($_POST['quantity']);

if (!isset($_SESSION['username'])) {
    echo "<script>alert('You need to be logged in to perform this action.'); window.location.href = 'login.php';</script>";
    exit();
}

if (empty($name)) {
    echo "<script>alert('Product name is required.'); window.history.back();</script>";
    exit();
}

if (empty($quantity) || !is_numeric($quantity) || $quantity <= 0) {
    echo "<script>alert('Please enter a valid quantity greater than zero.'); window.history.back();</script>";
    exit();
}

$quantity = (int)$quantity;

$username = $_SESSION['username'];
$userStmt = $conn->prepare("SELECT user_id FROM user WHERE username = ?");
$userStmt->bind_param("s", $username);
$userStmt->execute();
$userResult = $userStmt->get_result();

if ($userResult->num_rows > 0) {
    $userRow = $userResult->fetch_assoc();
    $user_id = $userRow['user_id'];
} else {
    echo "<script>alert('User not found. Please log in again.'); window.location.href = 'login.php';</script>";
    exit();
}

// Get or set product ID
$stmt = $conn->prepare("SELECT product_id FROM products WHERE product_name = ?");
$stmt->bind_param("s", $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product_id = $row['product_id'];
}

if ($action === 'stockOut') {

  
    $stmt = $conn->prepare("SELECT quantity FROM products WHERE product_name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['quantity'] >= $quantity) {
            $new_quantity = $row['quantity'] - $quantity;

            $stockOutStmt = $conn->prepare("INSERT INTO stockout (product_name , product_id , quantity, added_by) VALUES (?, ?, ?,?)");
            $stockOutStmt->bind_param("siii", $name,$product_id,$quantity, $user_id);
            $stockOutStmt->execute();

            if ($new_quantity > 0) {
                $updateStmt = $conn->prepare("UPDATE products SET quantity = ? WHERE product_name = ?");
                $updateStmt->bind_param("is", $new_quantity, $name);
                if ($updateStmt->execute()) {
                    echo "<script>alert('Stock updated successfully.'); window.location.href = '../dashboard.php';</script>";
                } else {
                    echo "<script>alert('Failed to update stock.'); window.history.back();</script>";
                }
            } else {
               
                $deleteStmt = $conn->prepare("DELETE FROM products WHERE product_name = ?");
                $deleteStmt->bind_param("s", $name);
                if ($deleteStmt->execute()) {
                    echo "<script>alert('Product out of stock and removed from inventory.'); window.location.href = '../dashboard.php';</script>";
                } else {
                    echo "<script>alert('Failed to remove product from inventory.'); window.history.back();</script>";
                }
            }
        } else {
            
            echo "<script>alert('Insufficient stock. Available quantity: {$row['quantity']}.'); window.history.back();</script>";
        }
    } else {
        
        echo "<script>alert('Product not found in inventory.'); window.history.back();</script>";
    }
}

$conn->close();
?>
