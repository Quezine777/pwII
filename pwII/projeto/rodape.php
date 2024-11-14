<?php
echo "<footer>";
echo "<p>Acessando por". $_SERVER['REMOTE_ADDR']. " em " .date('d/m/y')." </p>";
echo "<p>Desenvolvimento por Rafael &copy; 2021</p>";
echo "</footer>";
$banco->close();
?>