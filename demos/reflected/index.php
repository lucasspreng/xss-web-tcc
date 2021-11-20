<?php
$realizarBusca = isset($_GET['busca']);
function buscar($var)
{
    return strpos($var, $_GET['busca']) !== false;
}
$vulnerabilidades = [
    'XSS Baseado em DOM',
    'XSS Armazenado',
    'XSS Refletido'
];
$resultado = $realizarBusca ? array_filter($vulnerabilidades, 'buscar') : $vulnerabilidades;
?>


<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscador de Vulnerabilidades XSS</title>
</head>
<body>
    <h4>Buscador de Vulnerabilidades XSS</h4>

    <?php if (count($resultado) > 0) {?>
        <ol>
            <?php foreach ($resultado as $item) {
                echo '<li>'.$item.'</li>';
            }?>
        </ol>
    <?php } else {?>
        <i>Nenhum resultado encontrado para <strong><?php echo $_GET['busca']?></strong></i>
    <?php }?>

</body>
</html>