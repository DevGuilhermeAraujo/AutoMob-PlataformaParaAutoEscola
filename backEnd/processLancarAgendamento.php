<?php
include_once '../BackEnd/sessao.php';
include_once "../backEnd/modulos/permissionManager.php";
include_once "../backEnd/conexao.php";
$idUser = getId();
$db = new Conexao;
if (isset($_GET['horario']) && isset($_GET['dtEscolhida']) && isset($_GET['veicEscolhido'])) {
    $horario = $_GET['horario'];
    $dtEscolhida = $_GET['dtEscolhida'];
    $veiculoEscolhido = $_GET['veicEscolhido'];
    $db->executar("INSERT INTO agendamentos(aluno_id, Instrutor_id, carro_id, data_aula, horario_aula) VALUES('$idUser', 6,'$veiculoEscolhido', '$dtEscolhida', '$horario')");
    header("location: ../Usuario/homeUsuario.php?sucess");
}
