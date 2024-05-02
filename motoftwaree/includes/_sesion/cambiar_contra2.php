<?php 
require_once('../db.php');
$id = $_POST['id'];
$password = $_POST['new_password'];

$pass = sha1($password);

$query = "UPDATE user set password= '$pass' WHERE id= $id";
$conexion->query($query);

header("Location: ./index.html");

?>