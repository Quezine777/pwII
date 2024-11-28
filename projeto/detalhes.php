<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listagem de jogos</title>
    <link rel= "stylesheet" href="estilos/estilo.css">
</head>
<body>
    <?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    ?>
    <div id="corpo">
        <table class="listagem">
            <?php
            $c = $_GET['cod'] ?? 0;
            $busca = $banco->query("select * from jogos where cod = '$c'");
            ?>
            <h1>Detalhes do Jogo</h1>
            <table class='detalhes'>
                <?php
                if(!$busca){
                    echo "<tr><td>Busca falhou! $banco->error";
                }else{
                    if($busca->num_rows == 1){
                        $reg = $busca->fetch_object();
                        echo "<tr><td rowspan='3'> <img src='fotos/$reg->capa'> ";
                        echo "<td><h2>$reg->nome</h2>";
                        echo "<tr><td>$reg->nota/10";
                        echo "<tr><td>$reg->descricao";
                        echo "<tr><td>Adm";
                    }else{
                        echo "<tr><td>Nenhum registro encontrado";
                    }
                }
                ?>
            </table>