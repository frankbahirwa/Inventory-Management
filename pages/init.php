<?php
require_once './Backend/connection.php';

$sql = file_get_contents('database.sql');
try {
    $pdo->exec($sql);
    echo "Database initialized successfully.";
} catch (PDOException $e) {
    echo "Error initializing database: " . $e->getMessage();
}
?>






<?php
