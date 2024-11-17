<?php 
session_start();
require "./layout.php";
require "../Backend/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .upload-btn {
            font-size: 16px;
            padding: 12px 24px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        .upload-btn:hover {
            background-color: #45a049;
        }

        .file-input {
            padding: 12px;
            margin: 20px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
            font-size: 16px;
            color: #555;
        }

        .file-input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .file-label {
            font-size: 16px;
            color: #555;
            text-align: left;
            display: block;
            margin-bottom: 8px;
        }

        .upload-container {
            position: relative;
            padding: 40px 40px 30px 40px;
            background-color: #fafafa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            margin-top: 30px;
        }

        .remove-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #f44336;
            color: white;
            border-radius: 50%;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        .remove-btn:hover {
            background-color: #e53935;
        }

        .feedback {
            margin-top: 20px;
            color: #4CAF50;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Upload Profile Image</h1>

    <form action="../Backend/profiles.php" method="post" enctype="multipart/form-data">
        <div class="upload-container">
            <label class="file-label" for="profile_image">Select Profile Image:</label>
            <input type="file" name="profile_image" id="profile_image" class="file-input" accept="image/*" required>
        </div>

        <button type="submit" name="submit" class="upload-btn">Upload</button>
    </form>

    <div class="feedback">
        <?php
        if (isset($upload_status)) {
            echo $upload_status;
        }
        ?>
    </div>
</div>

</body>
</html>
