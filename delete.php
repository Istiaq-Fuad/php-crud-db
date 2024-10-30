<?php
require 'db.php';

if (isset($_GET['id'])) {
    $sql = "DELETE FROM books WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $_GET['id']]);
    header('Location: index.php');
    exit;
}
?>
