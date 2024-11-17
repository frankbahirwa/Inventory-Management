<?php
require "connection.php";
session_start();

if ($_POST) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkStmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
       
        echo "<script>alert('Username already exists. Please use a different name.');window.history.back();</script>";
    } else {
       
        $stmt = $conn->prepare("INSERT INTO user (username, password_hash) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
         
            $_SESSION['username'] = $username;
            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            echo "<script>alert('Registration failed. Please try again.');</script>";
        }
    }
}
?>
