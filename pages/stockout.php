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
        top:5cm;
        left: 6.8cm;
        border-radius: 5px;
        box-shadow: 0px 0px 12px lightgray;
    }

    /* Basic table styling */
    .table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
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
        width: 5%;
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
<th>Action</th>
</tr>
</thead>
<tbody>

<div class="button">
    <a href="./stockout-form.php"><button style="background:black;position:absolute; padding:.3cm;color:white;border:0;left:0;top:0;">Remove - Stock</button></a>
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


$slct = $conn->query("SELECT * FROM stockout WHERE added_by = $added_by  ORDER BY quantity DESC");
while ($row = $slct->fetch_assoc())
{?>
<tr>
<td style="text-align:center;"><?php echo $row['id']?></td>
<td><?php echo $row['product_name']?></td>
<td style="text-align:center;"><?php echo $row['quantity']?></td>
<td style="text-align:center;">
<a style="text-decoration:none;" href="?delete=<?php echo $row['id']; ?>" style="color:black;"><img style="width:20px;" src="./images/delete.png" alt=""></a>
<a style="text-decoration:none;" href="update.php?update=<?php echo $row['id']; ?>" style="color:black;"><img src="./images/update.png" alt=""></a>                             
<?php
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = $conn->query("DELETE FROM stockout WHERE product_id=$id");
    if (!$sql) {
        echo "<script>alert(Error deleting record)</script>"; 
    }   
}

?>

</td>
</tr>
        </tbody>
    </table>
</div>

</main>                  

</body>
</html>