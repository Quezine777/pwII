<?php
echo "<header>";
if(empty($_SESSION['user'])){
echo "<a href='user_login.php'>Entrar</a>";
}
else{
    echo "olá, <strong>" . $_SESSION['nome']."</strong> | ";
    echo "<a href='user_login.php'>Sair</a>";
}
echo "</header>";
?>