<?php
session_start();

if(!$_SESSION['username']){
    header("location: login.php");
    exit();
}

?>

<?php require "./backend/connection.php" ?>
<?php require './layout.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" href="../css/main.css?v=5">
<link rel="stylesheet" href="../css/component/stock-items-handler.css?v=5.0">
<style>
h1 {
margin-bottom: 20px;
color: #333;
}

.active >input, textarea{
margin: 10px 0;
padding: 10px;
width: calc(100% - 20px);
border: 1px solid #ccc;
border-radius: 5px;
outline-color:teal;

}
.form{
display:none;  

}

.active{
background: lightgray;
padding: 20px;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
width: 30%;
text-align: center;
height:fit-content;
animation: fadeIn 1s ease-in-out;
position:absolute;
left:15cm;
top:6cm; 
}

.remove{
position:absolute;
right:20px;
padding:5px;
color:teal;
background-color:white;
border-radius:50%;
cursor: pointer;
top:20px;
}

.buttons{
display: flex;
width:5cm;
margin-left:4cm;
gap:1cm;
margin-top:10px;
left:3cm;
}
.stockin{
background: rgb(117, 148, 148);
padding: 20px;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
width: 80%;
text-align: center;
height:65%;
animation: fadeIn 1s ease-in-out;
position:absolute;
left:6cm;
top:5cm;
}
.actives{
background: white;
padding: 20px;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
width: 80%;
text-align: center;
height:65%;
animation: fadeIn 1s ease-in-out;
position:absolute;
left:6cm;
top:5cm; 
}

.forms{
margin-top: 1.5cm;
}

.first{
display: flex;
flex-direction: column;
position: absolute;
gap: 1cm;
right: 7cm;
padding:20px;
}
.first > input{
width:8cm;
border: 1px solid gray;
height: 1cm;
border-radius: 10px;
outline:0;
padding-left: 10px;
}
.second{
display: flex;
flex-direction: column;
gap: 1cm;
position: absolute;
left: 7cm;
padding: 20px;
}
input{
width:8cm;
border: 1px solid gray;
height: 1cm;
padding-left:10px ;
outline: 0;
}
.buttons button{
border:0;
width:5cm;
height:0.8cm;
}
#stock-in #stock-out {
width:1cm;
margin: 10px 5px;
border: none;
border-radius: 5px;
cursor: pointer;
transition: background 0.3s;
}

button#stock-in {
background-color: teal;
color: white;
}

button#stock-out {
background-color: orangered;
color: white;
}

button:hover {
opacity: 0.9;
}

.inventory {
margin-top: 20px;
}

.inventory ul {
list-style: none;
padding: 0;
}

.inventory li {
padding: 10px;
border-bottom: 1px solid #ddd;
transition: background 0.3s;
}

.inventory li:hover {
background-color: #f9f9f9;
}

.stockout{
background: white;
padding: 20px;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
width: 50%;
text-align: center;
height:65%;
animation: fade 1s ease-in-out;
position:absolute;
left:12cm;
top:5cm; 
}

.sidebar{
position:absolute;
top:0;
}
.activens{
background: white;
padding: 20px;
border-radius: 10px;
box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
width: 80%;
text-align: center;
height:65%;
animation: fade 1s ease-in-out;
position:absolute;
left:6cm;
top:5cm; 
}

@keyframes fadeIn {
from {
opacity: 0;
transform: scale(0.5 );
}
to {
opacity: 1;
transform: scale(1);
}
}

@keyframes fade {
from {
opacity: 0;
transform: scale(0.5 );
}
to {
opacity: 1;
transform: scale(1);
}
}
                  


</style>
</head>
<body>
<div class="container">
<div class="stockout">
<div class="formed">
<form action="./Backend/stock-out.php"method="post">
<p style="color:teal;margin-bottom:3cm;">Stock - Out Items</p> 
<input type="text"  name = "name" id="item-name" placeholder="Item Name" style="width:10cm; height:0.5cm;"> <br><br>
<input type="number" name = "quantity" id="item-name" placeholder="Item Quantity" style="width:10cm;height:0.5cm;"><br><br>
<textarea  name="reason" id="description" placeholder="Reason for Stock-Out" style="width:10cm;"></textarea>
<div class="buttons">
<button id="stock-out" name="stock-out" style="width:10cm;position:absolute; left:5.1cm;border-radius:10px;">Stock Out</button>
</form>
</div>
</div>
<p class="remove" onclick="remove();">X</p>
</div>
</div>
<div class="inventory">
</div>
</div>
<script src="../js/items-handler.js">
</script>
</body>
</html>