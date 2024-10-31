<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Add New Book</h2>
        <form action="add.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>
            <div class="mb-3">
                <label for="pages" class="form-label">Pages</label>
                <input type="number" class="form-control" id="pages" name="pages" required>
            </div>
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="number" class="form-control" id="isbn" name="isbn" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="available" name="available" value="1">
                <label class="form-check-label" for="available">Available</label>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $pages = $_POST['pages'];
    $isbn = $_POST['isbn'];
    $available = isset($_POST['available']) ? 1 : 0; // Checkbox returns 1 if checked, otherwise 0

    // Insert into database
    $sql = "INSERT INTO books (title, author, available, pages, isbn) 
            VALUES (:title, :author, :available, :pages, :isbn)";
    $stmt = $pdo->prepare($sql);

    // Execute statement with form data
    if ($stmt->execute([
        ':title' => $title,
        ':author' => $author,
        ':available' => $available,
        ':pages' => $pages,
        ':isbn' => $isbn
    ])) {
        // Redirect back to main page if successful
        header('Location: index.php');
        exit;
    } else {
        echo "Error: Could not insert book into the database.";
    }
}
?>
