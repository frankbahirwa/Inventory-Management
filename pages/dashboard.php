<?php
session_start();

if(!$_SESSION['username']){
    header("location: login.php");
    exit();
}

?>
<?php require "./layout.php" ?>
<?php require '../Backend/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f1f3f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    .cards {
        display: flex;
        flex-wrap: wrap;
        gap: 3rem;
        left:6cm;
        padding: 2rem;
        position:fixed;
        top:2cm;
        justify-content: center;
    }

    /* Responsive container */
    .table-container {
        overflow-x: auto; /* Enable horizontal scroll if needed */
        overflow-y: auto; /* Enable vertical scroll */
        height: 60%; /* Set a fixed height for the table container */
        margin: 1rem 0;
        margin-bottom:3cm;
        padding-top:1cm;
        width: 82%;
        position: fixed;
        padding-bottom:2cm;
        top:7cm;
        left: 6.8cm;
        border-radius: 5px;
        box-shadow: 0px 0px 12px lightgray;
    }

    /* Basic table styling */
    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    /* Header row styling */
    .table thead tr {
        background-color: #f7f7f7;
        font-weight: bold;
    }

    .table th, .table td {
        padding: 0.75rem;
        border-bottom: 1px solid #e0e0e0;
        
    }

    /* Checkbox cell width */
    .table .checkbox-cell {
        /* width: 5%; */
    }

    td{
        text-align:center;
        
    }
    /* Actions cell */
    .table .actions-cell {
        text-align: center;
        width: 10%;
    }

    .table .status-low {
        color: #ff5252;
        font-weight: bold;
    }

    .table .status-in-stock {
        color: #4caf50;
        font-weight: bold;
    }

    .table tbody tr:hover {
        background-color: #f0f4f8;
        transition: background-color 0.3s;
    }

    main {
        position: relative;
        height: 100vh;
        overflow-y: auto;
        width:fit-content; 
    }

    .right-panel{
        display:none;
    }
    .show{
        display:block;
        position:absolute;
        top:7cm;
        background-color:red;
        padding:1cm;
    }
    @media (max-width: 768px) {
        .table thead {
            display: none;
        }
        
        .table tr {
            display: block;
            margin-bottom: 1rem;
            border-bottom: 1px solid #ddd;
        }

        .table td {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem;
        }

        .table td:before {
            content: attr(data-label);
            font-weight: bold;
            width: 50%;
        }
    }
</style>
</head>
<body>

<main>
<div class="right-panel">
<form action="#" id="login-form" method="post">
<div>
<br><br><br><br>
<input type="text" id="product" name="product_name" placeholder="product_name*" required />
</div>

<button type="submit">Add</button> <br> <br>

</form>
<?php
if($_POST){
$action = 'stockIn';

$name = trim($_POST['product_name']);
$description = '';
$price = 0;
$quantity = 0;
$supplier = '';
$category = '';
$product_image_path = 'none';

$errors = [];


if (empty($name)) {
$errors[] = "Product name is required.";
}

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


$stmts = $conn->prepare("SELECT product_name FROM products WHERE product_name = ?");
$stmts->bind_param("s", $name);
$stmts->execute();
$result = $stmts->get_result();
$slct = $result->fetch_assoc();

if(!$slct){
   
$stmt = $conn->prepare("INSERT INTO products (product_name, description, price, quantity, supplier, category, product_image_path, added_by, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
$stmt->bind_param("ssdiissi", $name, $description, $price, $quantity, $supplier, $category, $product_image_path, $added_by);
$stmt->execute();

     if($stmt){
        echo "<script>alert('product recorded successfully.'); window.location.href = './dashboard.php';</script>";
        }
}
else{
echo "<script>alert(' products added before.');window.history.back()";
}


}

?>
</div>

<div class="cards">
<?php
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

 
$productCountStmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE added_by = ?");
$productCountStmt->bind_param("i", $added_by);
$productCountStmt->execute();
$productCountResult = $productCountStmt->get_result();
$productCount = $productCountResult->fetch_assoc()['COUNT(*)'];

$stockouts = $conn->prepare("SELECT COUNT(*) FROM stockout WHERE added_by =$added_by");
$stockouts->execute();
$stockoutResult = $stockouts->get_result();
$stockoutcount = $stockoutResult->fetch_assoc()['COUNT(*)'];

$stockinss = $conn->prepare("SELECT COUNT(*) FROM stockin WHERE added_by =$added_by");
$stockinss->execute();
$stockinsResult = $stockinss->get_result();
$stockinscount = $stockinsResult->fetch_assoc()['COUNT(*)'];

$userCountStmt = $conn->prepare("SELECT COUNT(*) FROM user");
$userCountStmt->execute();
$userCountResult = $userCountStmt->get_result();
$userCount = $userCountResult->fetch_assoc()['COUNT(*)'];

$stockCountStmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE quantity > 0 ORDER BY quantity DESC");
$stockCountStmt->execute();
$stockCountResult = $stockCountStmt->get_result();
$stockCount = $stockCountResult->fetch_assoc()['COUNT(*)'];

$userCountStm = $conn->prepare("SELECT COUNT(quantity) FROM products WHERE quantity <= 20 && added_by = $added_by");
$userCountStm->execute();
$userCountResults = $userCountStm->get_result();
$userCounts = $userCountResults->fetch_assoc()['COUNT(quantity)'];
$plansCount = $userCounts;
   
$cards = [
    ['title' => 'Current - Stock', 'description' => $productCount, 'link' => 'login.html'],
    ['title' => 'Stock - Outs', 'description' => $stockoutcount, 'link' => 'login.html'],
    ['title' => 'Stock - Ins', 'description' => $stockinscount, 'link' => 'login.html'],
    ['title' => 'Low - in - Stock', 'description' => $plansCount, 'link' => 'login.html']
];

    foreach ($cards as $cardData) {
        $title = $cardData['title'];
        $description = $cardData['description'];
        $link = $cardData['link'];
        include 'cards.php';
    }
    ?>

</div>
<?php 
    if($_SESSION['username']){
  echo $_SESSION['username'];
    }

?>
<div class="table-container">
<table class="table">
<thead>
<tr>
<th>Item Serial</th>    
<th>Item Name</th>
<th>Item Quantity</th>
<th>Item Price</th>
<th>Item Category</th>
<th>total price</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<div class="button">
    <a href="./addproduct.php"><button class="button" style="background:black;position:absolute; padding:.3cm;color:white;border:0;left:0;top:0;">Add - Product</button></a>
</div>       
<?php
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

$userCountStm = $conn->prepare("SELECT COUNT(quantity) AS product_count FROM products WHERE quantity <= 20 && added_by = $added_by");
$userCountStm->execute();
$userCountResults = $userCountStm->get_result();
$userCounts = $userCountResults->fetch_assoc()['product_count'];
$plansCount = $userCounts;


$slct = $conn->query("SELECT * FROM products WHERE added_by = $added_by  ORDER BY quantity DESC");
while ($row = $slct->fetch_assoc())
{?>
<tr>
<td style="text-align:center;"><?php echo $row['product_id']?></td>
<td><?php echo $row['product_name']?></td>
<td style="text-align:center;"><?php echo $row['quantity']?></td>
<td style="text-align:center;"><?php echo $row['price']?> Rwf/Kg</td>
<td style="text-align:center;"><?php echo $row['category']?></td>
<td style="text-align:center;"><?php echo $row['price'] * $row['quantity'] ;?></td>
<td style="text-align:center;">
<?php
$status = $plansCount; if($status <= 20){ $stat = "Low in stock";} else{$stat = "Available";} echo $stat;
 ?>
</td>
</td>
<td style="text-align:center;">
<a style="text-decoration:none;" href="?delete=<?php echo $row['product_id']; ?>" style="color:black;"><img style="width:20px;" src="../images/delete.png" alt=""></a>
<a style="text-decoration:none;" href="update.php?update=<?php echo $row['product_id']; ?>" style="color:black;"><img src="../images/update.png" alt=""></a>                             
<?php
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE FROM products WHERE product_id=$id");
    if ($sql) {
        echo "<script>alert(deleted record);window.history.back();</script>"; 
    }   
}
?>

</td>
</tr>
        </tbody>
    </table>
</div>

</main>  
<script>
    const Right = document.querySelector('.right-panel');
    const button = document.querySelector('.button');

    button.addEventListener('click', () => {
        Right.classList.toggle('show');
        Right.classList.toggle('right-panel');
    });
</script>

</body>
</html>
