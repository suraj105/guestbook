<?php

require_once __DIR__ . '/inc/db-connect.php';
require_once __DIR__ . '/inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {

    // Fetch input values safely and trim them to avoid unnecessary spaces
    $title = isset($_POST['title']) ? trim((string)$_POST['title']) : '';
    $name = isset($_POST['name']) ? trim((string)$_POST['name']) : '';
    $content = isset($_POST['content']) ? trim((string)$_POST['content']) : '';

    // Check if all required fields are provided
    if ($title && $name && $content) {
        // Use a prepared statement for inserting into the database
        $stmt = $pdo->prepare('INSERT INTO entries (name, title, content) VALUES (:name, :title, :content)');
        $stmt->execute([
            ':name' => $name,
            ':title' => $title,
            ':content' => $content
        ]);

        // Redirect after successful entry to avoid resubmission on page reload
        header('Location: index.php');
        exit();
    } else {
        $errorMessage = 'Please fill in all the required fields.';
    }
} else {
    $errorMessage = 'There was an error processing your request.';
}

// Render the index page with an error message (if applicable)
require __DIR__ . '/index.php';
