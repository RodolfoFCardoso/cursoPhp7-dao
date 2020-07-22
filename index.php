
<?php 

require_once("config.php");
/*
$sql = new sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);
*/

//Carrega um usuário

/**
$root = new Usuario();
$root->loadById(4);
echo $root;

$usuario = new Usuario();
$usuario->loadById(7);
echo($usuario);
*/

// Carrega uma lista de usuários
/*
$lista = Usuario::getList();
echo json_encode($lista);
*/

//Carrega uma lista de usuários buscando pelo Login
/*
$search = Usuario::search("Ia");
echo json_encode($search);
*/

//Carrega um usuário usando login e senha
$login = new Usuario();
$login->login("Iara", "1234");
echo $login;

 ?>