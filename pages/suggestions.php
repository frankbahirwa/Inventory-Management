<?php
session_start();
require_once "../Backend/connection.php";

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("SELECT user_id FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $added_by = $user['user_id'];

      
        $stmt = $conn->prepare("SELECT product_name FROM products WHERE product_name LIKE ? AND added_by = ?");
        $searchTermWildcard = "%$term%";
        $stmt->bind_param("si", $searchTermWildcard, $added_by);
        $stmt->execute();
        $results = $stmt->get_result();

        $suggestions = [];
        while ($row = $results->fetch_assoc()) {
            $suggestions[] = $row['product_name'];
        }

        
        echo json_encode($suggestions);
    } else {
        echo json_encode([]);
    }
}
?>
