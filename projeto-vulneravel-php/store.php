<?php
include_once 'config/connect.php';

try {
    $pdo = new PDOConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('INSERT INTO posts (content, title) VALUES(:content, :title)');
    $stmt->execute(array(
        ':content' => $_POST['content'],
        ':title' => $_POST['title']
    ));

    header('Location: index.php');
} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}