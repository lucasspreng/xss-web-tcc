<?php

include_once 'connect.php';
$posts = [];
try {
    $pdo = new PDOConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = $pdo->query("SELECT content FROM posts;");

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        array_push($posts, $linha['content']);
    }

    array_shift($posts);
} catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nova Publicação</title>
    <style>
        form > * {
            margin: 10px;
        }
        .row {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 80%;
            margin: 0 10%;
        }
    </style>
</head>
<body>
<div class="row">
    <div>
        <h4>Nova Publicação</h4>
        <form action="store.php" method="POST">
            <label for="content">Conteúdo da Publicação:</label> <br>
            <textarea rows="3" cols="20" id="content" name="content"></textarea> <br>
            <input type="submit" value="Enviar!">
        </form>
    </div>
    <div>
        <h4>Listagem de publicações</h4>
        <ul>
            <?php
            foreach ($posts as $post) {
                echo '<li>'.$post.'</li>';
            }
            ?>
        </ul>
    </div>
</div>

</body>
</html>
