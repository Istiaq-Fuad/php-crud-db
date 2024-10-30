<?php
require 'db.php';

if (isset($_GET['id'])) {
    $sql = "SELECT * FROM books WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $_GET['id']]);
    $book = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE books SET title = :title, author = :author, available = :available, 
            pages = :pages, isbn = :isbn WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $_POST['title'],
        ':author' => $_POST['author'],
        ':available' => isset($_POST['available']) ? 1 : 0,
        ':pages' => $_POST['pages'],
        ':isbn' => $_POST['isbn'],
        ':id' => $_GET['id']
    ]);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Edit Book</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="pages" class="form-label">Pages</label>
                <input type="number" class="form-control" id="pages" name="pages" value="<?= $book['pages'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="number" class="form-control" id="isbn" name="isbn" value="<?= $book['isbn'] ?>" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="available" name="available" <?= $book['available'] ? 'checked' : '' ?>>
                <label class="form-check-label" for="available">Available</label>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
