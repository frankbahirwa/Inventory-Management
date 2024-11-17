<?php
session_start();
require './layout.php';
if(!$_SESSION['username']){
header("location:login.php");
exit();
}
?>
<?php 
require '../Backend/connection.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-product</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f1f3f5;
    margin: 0;
}



.search{
    width:1cm;
}

.sidebar{
    position:absolute;
    top:0;
}


.container {
    background-color: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    justify-content:space-between;
    width: 15cm;
    max-width: 800px;
    margin: auto;
    margin-top:5cm;
    overflow: hidden;
    padding-right:2cm;
}

.left-panel {
    background-color: #f9f9f9;
    display: none; 
}

.right-panel {
    padding: 20px;
    margin-left:2cm;
}

.right-panel h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    
}

input[type="text"],
input[type="password"] {
    width: 97%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 15px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #007bff;
    outline: none;
}

button {
    width: 100%;
    padding: 10px;
    background-color: forestgreen; 
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #e68a00; 
}

.socials {
    text-align: center;
}

.social-icons {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.social-icons img {
    width: 40px; 
    height: 40px; 
}


@media (min-width: 768px) {
    .container {
        flex-direction: row;
    }

    .left-panel {
        width: 50%;
        display: flex; 
        align-items: center;
        justify-content: center;
    }

    .right-panel {
        width: 50%;
    }
}

</style>
</head>
<body>
<main style="margin-top:3.5cm;">
<div class="container">
<div class="left-panel">
<img src="../images/rea.png" height="300px" alt="" class="max-w-full h-auto"/>
</div>
<div class="right-panel">
<form action="#" id="login-form" method="post">
<div>
<br><br><br><br>
<input type="text" id="product" name="product_name" placeholder="product_name*" required />
<select name="category" id="category" style="
width:4.6cm;
border: 1px solid gray;
height: 1cm;
border-radius: 10px;
padding-left:10px ;
outline: 0;
">

<option value=""selected> -- take an option -- </option>
<option value="clothes">clothes</option>
<option value="shoes">shoes</option>
<option value="food">food & related</option>
<option value="other">other</option>
</select>  <br><br> 
</div>

<button type="submit">Add</button> <br> <br>

</form>
<?php
if ($_POST) {
    $action = 'stockIn';

   
    $name = trim($_POST['product_name']);
    $category = trim($_POST['category']); 
    $description = '';
    $price = 0;
    $quantity = 0;
    $supplier = '';
    $product_image_path = 'none';

    $errors = [];

    if (empty($name)) {
        $errors[] = "Product name is required.";
    }

    if (empty($category)) {
        $errors[] = "Category is required.";
    }

    
    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "'); window.history.back();</script>";
        exit;
    }

 
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT user_id FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "<script>alert('User not found.'); window.history.back();</script>";
        exit;
    }

    $added_by = $user['user_id'];


    $stmts = $conn->prepare("SELECT product_name FROM products WHERE product_name = ?");
    $stmts->bind_param("s", $name);
    $stmts->execute();
    $result = $stmts->get_result();
    $slct = $result->fetch_assoc();

    if (!$slct) {
      
        $stmt = $conn->prepare("INSERT INTO products (product_name, description, price, quantity, supplier, category, product_image_path, added_by, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("ssdiissi", $name, $description, $price, $quantity, $supplier, $category, $product_image_path, $added_by);
        $stmt->execute();

        if ($stmt) {
            echo "<script>alert('Product recorded successfully.'); window.location.href = './dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to record product.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Product already exists.'); window.history.back();</script>";
    }
}
?>

</div>
</div>
</main>
    <script src="script.js"></script>
</body>
</html>
