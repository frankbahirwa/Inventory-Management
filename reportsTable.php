<?php 
require './Backend/connection.php';
session_start();
if(!$_SESSION['username']){
    header("location:./login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        user-select:none;
    }
    .container {
        margin-top:3cm;
        position:absolute;
        width: 80%;
        margin-left:5.5cm;
        border: 1px solid #000;
        padding: 20px;
        margin-bottom:2cm;
    }
    .header {
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #000;
        padding-bottom: 10px;
    }
    .header img {
        width: 80px;
        margin-right: 15px;
    }
    .header-content {
        text-align: center;
    }
    .university-name {
        font-size: 22px;
        font-weight: bold;
        margin: 0;
    }
    .location {
        font-size: 18px;
        margin: 5px 0;
    }
    .program-name {
        font-size: 16px;
        margin-bottom: 10px;
    }
    .statement-title {
        font-size: 20px;
        font-weight: bold;
        margin-top: 5px;
    }
    .info {
        margin-top: 20px;
        font-size: 14px;
    }
    .info p {
        margin: 5px 0;
    }
    .grades-table {

        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .grades-table th, .grades-table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
    }
    .grades-table th {
        background-color: #f2f2f2;
    }
    .total-row {
        font-weight: bold;
    }
    .footer {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
</style>
</head>
<body>
<div class="container">
    <div class="header" style="padding:0.5cm;">
        <img src="./images/logos.jpg" style="position:absolute;left:0;" alt="Amity Logo">
        <div class="header-content">
            <p class="university-name">Xy-Shop Centralized Reports</p>
            <button id="exportBtn" style="cursor:pointer;background:green; padding:10px; border-radius:5px;position:absolute;right:3rem;top:0.5cm;color:white;border:0;">Export</button>
        </div>
    </div>

    <div class="info">
        <p><strong>Name of the Institution : </strong> Xy - Shop</p>
        <p><strong>User - Name : </strong> <?php echo ucfirst($_SESSION['username']); ?></p>
    </div>

    <table class="grades-table">
        <thead>
            <tr>
                <th>SL. NO.</th>
                <th>Product - Name</th>
                <th>Current - Quantity</th>
                <th>Stockins</th>
                <th>StockOuts</th>
                <th>Dates</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

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


        $products = $conn->query("SELECT * FROM products WHERE added_by=$added_by");

        while($row = $products->fetch_assoc()){
            $PROID = $row['product_id'];

            $koko = false;
            $outss;
            if($koko){
                $outss = 0;
            }

            else{

                $stockouts = $conn->prepare("SELECT COUNT(*) FROM stockout WHERE added_by =$added_by && product_id =$PROID");
                $stockouts->execute();
                $stockoutResult = $stockouts->get_result();
                $stockoutcount = 0;
                $outss = $stockoutcount ? 0: $stockoutResult->fetch_assoc()['COUNT(*)'];

            }

        $outs = $conn->query("SELECT * FROM stockout WHERE added_by=$added_by");

        while($outrow = $outs->fetch_assoc())
        
        $stcokins;
        if(!true){
            $stcokins=0;   
        }   
        
        else{

            $stockinss = $conn->prepare("SELECT COUNT(*) FROM stockin WHERE added_by =$added_by && product_id =$PROID");
            $stockinss->execute();
            $stockinsResult = $stockinss->get_result();
            $stockinscount = 0;
            $stcokins = $stockinscount ? 0:$stockinsResult->fetch_assoc()['COUNT(*)'];

        }
  

        
        {?>

            <tr>
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $stcokins; ?></td>
                <td><?php echo $outss; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                <?php
                $status = $row['quantity']; if($status <= 20){ $stat = "Low in stock";} else{$stat = "Available";} echo $stat; ?></td>
            </tr>
  
       <?php }

        } 
        
        ?>
        </tbody>
    </table>

    <?php 

$stockCountStmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE quantity >= 0  && added_by=$added_by   ORDER BY quantity DESC");
$stockCountStmt->execute();
$stockCountResult = $stockCountStmt->get_result();
$stockCount = 0;
$data = $stockCount ? 'no quantity added' : $stockCountResult->fetch_assoc()['COUNT(*)'];

$koko = false;
$outss;
if($koko){
    $outss = 0;
}

else{

    $stockouts = $conn->prepare("SELECT COUNT(*) FROM stockout WHERE added_by =$added_by");
    $stockouts->execute();
    $stockoutResult = $stockouts->get_result();
    $stockoutcount = 0;
    $outsss = $stockoutcount ? 0: $stockoutResult->fetch_assoc()['COUNT(*)'];

}

    ?>

    <div class="footer">
        <p><strong>Current - Stock:</strong> <?php echo $data; ?></p>
        <p><strong>Total-stock-outs:</strong> <?php echo $outsss; ?></p>
        <p>Prepared by: _xy shop_ System__</p>
        <p>Checked by: __<?php echo ucfirst($_SESSION['username']); ?>__</p>
    </div>

</div>

<script>
document.getElementById("exportBtn").addEventListener("click", function() {
  
    const containerContent = document.querySelector(".container").innerHTML;

    const printWindow = window.open("", " : _Xy Shop");
    printWindow.document.open();
    printWindow.document.write(`
        <html>
        <head>
        <title>Print</title>
       <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
    }
    .container {
        margin-top:3cm;
        position:absolute;
        width: 80%;
    
        border: 1px solid #000;
        padding: 20px;
        margin-bottom:2cm;
    }
    .header {
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #000;
        padding-bottom: 10px;
    }
    .header img {
        width: 80px;
        margin-right: 15px;
    }
    .header-content {
        text-align: center;
    }
    .university-name {
        font-size: 22px;
        font-weight: bold;
        margin: 0;
    }
    .location {
        font-size: 18px;
        margin: 5px 0;
    }
    .program-name {
        font-size: 16px;
        margin-bottom: 10px;
    }
    .statement-title {
        font-size: 20px;
        font-weight: bold;
        margin-top: 5px;
    }
    .info {
        margin-top: 20px;
        font-size: 14px;
    }
    .info p {
        margin: 5px 0;
    }
    .grades-table {

        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .grades-table th, .grades-table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
    }
    .grades-table th {
        background-color: #f2f2f2;
    }
    .total-row {
        font-weight: bold;
    }
    .footer {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
</style>
        </head>
        <body onload="window.print(); window.close();">
            <div class="container">
                ${containerContent}
            </div>
        </body>
        </html>
    `);
    printWindow.document.close();
}); -->
<!-- </script>
</body>
</html>
