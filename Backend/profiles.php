<?php
session_start();
require 'connection.php'; 

if (isset($_POST['submit'])) {

    if (!isset($_SESSION['username'])) {
        echo "<script>alert('User session is not set. Please log in.');window.history.back();</script>";
        exit;
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

   
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $image_name = basename($_FILES['profile_image']['name']);
        $image_tmp_name = $_FILES['profile_image']['tmp_name'];
        $image_size = $_FILES['profile_image']['size'];

       
        if ($image_size > 2097152) {
            echo "<script>alert('File size should not exceed 2MB.');window.history.back();</script>";
            exit;
        }

        $upload_dir = '../assets/profiles/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $unique_name = uniqid('profile_', true) . '_' . $image_name;
        $image_path = $upload_dir . $unique_name;

    
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            $image_relative_path = 'assets/profiles/' . $unique_name;
            $created_at = date('Y-m-d H:i:s');

            $stmt = $conn->prepare("INSERT INTO profiles (image, added_by, created_at) VALUES (?, ?, ?)");
            $stmt->bind_param("sis", $image_relative_path, $added_by, $created_at);

            if ($stmt->execute()) {
                echo "<script>alert('Profile uploaded successfully.');window.location.href='../pages/dashboard.php';</script>";
            } else {
                echo "<script>alert('Database error: " . $conn->error . "');window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image.');window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Please select an image to upload.');window.history.back();</script>";
    }
}
?>