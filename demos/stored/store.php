<?php
include_once 'connect.php';

try {
    $pdo = new PDOConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare('INSERT INTO posts (content) VALUES(:content)');
    $stmt->execute(array(
        ':content' => $_POST['content']
    ));

    header('Location: index.php');
} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}