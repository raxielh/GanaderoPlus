<?php
$user = 'postgres';
$passwd = 'rodrigo8907';
$db = 'ganaderoplus';
$port = 5432;
$host = 'localhost';
$strCnx = "host=$host port=$port dbname=$db user=$user password=$passwd";
$cnx = pg_connect($strCnx) or die ("Error de conexion. ". pg_last_error());
echo "Conexion exitosa <hr>";
?>