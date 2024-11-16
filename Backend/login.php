<?php
session_start();
require "connection.php";

$error = '';

if ($_POST) {

$user = $_POST['username'];

$pass = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");

$stmt->bind_param("s", $user);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {

$row = $result->fetch_assoc();

if (password_verify($pass,$row['password_hash'])) {
header("Location:../pages/dashboard.php");
$_SESSION['loggedin'] = true;

$_SESSION['username'] = $user;
echo "logged in successfully";

}

else{
echo "<script>alert('failed to log in .'); window.history.back();</script>";
}

// if (isset($_POST['remember'])) {

// $cookie_value = $user;

// setcookie('remember_user', $cookie_value,time() + (20 * 60), '/');
// }

// header("Location: ./user/pages/home.php");

// exit();

} else {

$error = "Incorrect password";
header("Location:../login.php");
echo "<script>alert('the credentials provided are not correct')</script>";

}
} else {

$error = "No user found with username " . $user;
header("Location:../signup.php");

}

$stmt->close();