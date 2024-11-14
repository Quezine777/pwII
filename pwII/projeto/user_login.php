<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel= "stylesheet" href="estilos/estilo.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            padding: 40px 20vw 0 20vw;
        }
    </style>

</head>
<body>
    <?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "includes/login.php";
    ?>

    <div id="corpo">
        <?php
            $u = $_POST['usuario'] ?? null;
            $s = $_POST['senha'] ?? null;

            $_SESSION['user']= null;
            $_SESSION['nome']= null;
            $_SESSION['tipo']= null;
            
            if (is_null($u) || is_null($s)) {
                require "user_login_form.php";
            }

            else {
                $query = "select * from usuarios where usuario = '$u' limit 1";

                $busca = $banco->query($query);

                if (!$busca) {
                    echo 'Falha ao acessar o banco!';
                } else {
                    if ($busca->num_rows>0) { // Caso usuário exista

                        $reg = $busca->fetch_object();
                        
                        if (testarHash($s, $reg->senha)) {
                            echo 'Logado com sucesso!';
                            $_SESSION['user'] = $reg->usuario;
                            $_SESSION['nome'] = $reg->nome;
                            $_SESSION['tipo'] = $reg->tipo;
                            
                            echo '<br><a href="index.php">Voltar para o inicio</a>';
                        }
                        else {
                            echo 'Senha inválida!';
                        }
                    } else {
                        echo 'Login inválido!';
                    }
                }
            }
        ?>

        
</body>
</html>