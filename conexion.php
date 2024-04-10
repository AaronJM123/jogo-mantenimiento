<?php

$db_host ="localhost"; 	//se declara la variable para el nombre del servidor
$db_user ="root";	//se declara la variable el nombre de usuario
$db_pass ="";	//se declara la variable la clave del usuario
$db_databas = "jogo"; //se declara la variable del nombre de la base de datos

try
{
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_databas",$db_user,$db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  echo "ERROR CONECTING TO DATABASE" . $e->getMessage();
  exit();
}
?>