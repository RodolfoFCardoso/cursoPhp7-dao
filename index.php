
<?php 

require_once("config.php");
/*
$sql = new sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
*/

$root = new Usuario();

$root->loadById(4);

echo $root;

$usuario = new Usuario();

$usuario->loadById(7);

echo($usuario);
 ?>
