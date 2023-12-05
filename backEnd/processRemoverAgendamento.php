<?php
include_once "conexao.php";
$db = new Conexao;
if (isset($_GET['idAgendamento'])) {
    $idAgendamento = $_GET['idAgendamento'];
    $db->executar("DELETE FROM agendamentos WHERE id = $idAgendamento");
    header("location: ../Usuario/homeUsuario.php?sucess");
}
