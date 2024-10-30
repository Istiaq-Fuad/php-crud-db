<?php
require 'db.php';

$books = [
    [
        'title' => 'To Kill A Mockingbird',
        'author' => 'Harper Lee',
        'available' => true,
        'pages' => 336,
        'isbn' => 9780061120084
    ],
    [
        'title' => '1984',
        'author' => 'George Orwell',
        'available' => true,
        'pages' => 267,
        'isbn' => 9780547249643
    ],
    [
        'title' => 'One Hundred Years Of Solitude',
        'author' => 'Gabriel Garcia Marquez',
        'available' => false,
        'pages' => 457,
        'isbn' => 9785267006323
    ]
];

$sql = "INSERT INTO books (title, author, available, pages, isbn) 
        VALUES (:title, :author, :available, :pages, :isbn)";

$stmt = $pdo->prepare($sql);

foreach ($books as $book) {
    $stmt->execute([
        ':title' => $book['title'],
        ':author' => $book['author'],
        ':available' => $book['available'] ? 1 : 0, // Convert boolean to integer
        ':pages' => $book['pages'],
        ':isbn' => $book['isbn']
    ]);
}

echo "Books inserted successfully!";
?>
