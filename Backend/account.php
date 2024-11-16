<?php
require "connection.php";
session_start();
if($_POST){
$username = $_POST['username'];
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO user(username, password_hash) VALUES ('$username','$password')");
$stmt->execute();
if($stmt){
header("location:../dashboard.php");
$_SESSION['username'] = $username;
}

}