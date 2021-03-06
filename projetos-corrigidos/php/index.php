<?php

include_once 'config/connect.php';

$posts = [];

try {
    $pdo = new PDOConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $consulta = $pdo->query("SELECT content, title FROM posts;");

    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        array_push($posts, $linha);
    }


    if (isset($_GET['filter']) && $_GET['filter'] !== '') {
        $posts = array_filter($posts, function($k) {
            return stripos(strtolower($k['title']), strtolower($_GET['filter'])) !== FALSE;
        });
    }
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
    <title>Publicações</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Projeto Vulnerável</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Título da Publicação" aria-label="Search" name="filter">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>

<div class="container d-flex justify-content-center">

    <div class="col-12 col-sm-10 col-md-8 col-lg-6 text-center">

        <div class="card my-4">
            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#collapse-form" aria-expanded="false" aria-controls="collapse-form">Nova Publicação</div>
            <form class="col collapse" id="collapse-form" action="store.php" method="post">
                <div class="card-body">
                        <input class="form-control me-2 mb-2" type="text" placeholder="Título da Publicação" required name="title">
                        <textarea class="form-control me-2" placeholder="Conteúdo da publicação" required name="content"></textarea>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button class="btn btn-success" type="submit">Enviar publicação</button>
                </div>
            </form>

        </div>

        <?php if (isset($_GET['filter']) && $_GET['filter'] !== '') { ?>
            <h6><?php echo count($posts) .' '. (count($posts) === 1 ? 'publicação' : 'publicações') .' encontradas para "<strong>'. $_GET['filter'] .'</strong>"' ?></h6>
            <a href="index.php" class="btn btn-secondary p-1 text-center"><small>Exibir todas as publicações</small></a>
        <?php } else { ?>
            <h6><?php echo count($posts) > 0 ? 'Exibindo '. count($posts) .' publicações' : 'Nenhuma publicação encontrada' ?></h6>
        <?php } ?>

        <?php
        foreach ($posts as $post) {
            echo '<div class="card my-2 text-start"><div class="card-header">'. $post['title'] .'</div><div class="card-body">'. $post['content'] .'</div></div>';
        }
        ?>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
