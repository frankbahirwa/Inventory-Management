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
        height:fit-content; /* Set a fixed height for the table container */
        margin: 1rem 0;
        margin-bottom:3cm;
        padding-top:1cm;
        width: 82%;
        position: fixed;
        padding-bottom:2cm;
        top:5cm;
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
<?php
if (isset($_SESSION['search_query'])) {
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
$searchTerm = $_SESSION['search_query'];

$stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ? AND added_by = ?");
$searchTermWildcard = "%$searchTerm%";
$stmt->bind_param("si", $searchTermWildcard, $added_by); 
$stmt->execute();
$results = $stmt->get_result();

$userCountStm = $conn->prepare("SELECT COUNT(quantity) AS product_count FROM products WHERE quantity <= 20 && added_by = $added_by");
$userCountStm->execute();
$userCountResults = $userCountStm->get_result();
$userCounts = $userCountResults->fetch_assoc()['product_count'];
$plansCount = $userCounts;

if ($results->num_rows > 0) {
while ($row = $results->fetch_assoc()) { ?>
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


unset($_SESSION['search_query']);
}

else {
$error ="No results found for :  " . htmlspecialchars($searchTerm);
}
?>

</td>
</tr>
        </tbody>
    </table>
    <div class="error">
    <p style="color:red;font-size:20px;position:absolute;bottom:1cm;left:4cm;"><?php if(!empty($error)){echo $error;} ?></p>
    </div>
</div>
<?php }
?>
</main>  


</body>
</html>
