<?php
include_once "conexao.php";
$db = new Conexao;
if (isset($_GET['idCarro'])) {
    $idCarro = $_GET['idCarro'];
    $db->executar("DELETE FROM carros WHERE id = $idCarro");
    //header("location: ../Usuario/homeUsuario.php?sucess");
}