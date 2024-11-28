<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Listagem de jogos</title>
    <link rel= "stylesheet" href="estilos/estilo.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <?php
    //ligaçoes com outros arquivos php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "includes/login.php";
    $ordem =$_GET['o'] ?? "n";
    $chave =$_GET['c'] ?? "";
    ?>
    <div id="corpo">
    <?php include_once "topo.php";?>
        <h1>Escolha seu jogo</h1>

        
          <!--<?php echo msg_sucesso(' sucesso! ')?>
            <?php echo msg_aviso(' aviso! ')?>
            <?php echo msg_erro(' erro! ')?>-->


        <form method="get" id="busca" action="index.php">
            Ordenar:
            <a href="index.php?o=n">Nome</a> |
            <a href="index.php?o=p">Produtora</a> |
            <a href="index.php?o=n1">Nota Alta</a> |
            <a href="index.php?o=n2">Nota Baixa</a> |
            <a href="index.php?o=g">Genero</a> |
            <a href="index.php">Mostrar Todos</a> |
            Buscar: <input type="text" name="c" size="10" maxlength="40"/>
            <input type="submit" value="OK"/>
        </form>

        <table class="listagem">
            <?php
            $q="select j.cod, j.nome, j.capa, g.genero, p.produtora from jogos j
            join generos g on j.genero=g.cod join produtoras p on j.produtora=p.cod ";
            if(!empty($chave)){
                $q .="where j.nome like '%$chave%' or p.produtora like '%$chave%' or g.genero like '%$chave%' ";
            }
                
            switch ($ordem){
                default:
                    $q .="order by j.nome"; 
                    break;  
                case "p":
                    $q .="order by p.produtora";
                    break;
                case "n1":
                    $q .="order by j.nota desc";
                    break;
                case "n2":
                    $q .="order by j.nota asc";
                    break;
                case "g":
                    $q .="order by g.genero";
            }

            $busca = $banco->query($q);
            if(!$busca){
                echo "<tr><td>Infelizmente a busca deu errado";
            }else{
                if($busca->num_rows==0){
                    echo "<tr><td>Nenhum registro encontrado";
                }else{
                    while($reg=$busca->fetch_object()){
                        $t = thumb($reg->capa);
                        echo "<tr><td><img src='$t' class='mini'/>";
                        echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
                        echo " [$reg->genero]";
                        echo "<br>$reg->produtora";
                        echo "<td>Adm";
                    }
                }
            }
            ?>
        </table>
        </div>
        <?php include_once "rodape.php";?>




</body>
</html>