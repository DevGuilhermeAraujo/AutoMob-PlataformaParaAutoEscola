<?php
include_once "conexao.php";
$db = new Conexao;
if (isset($_GET['horario']) && isset($_GET['dtEscolhida']) && isset($_GET['veicEscolhido'])) {
    $horario = $_GET['horario'];
    $dtEscolhida = $_GET['dtEscolhida'];
    $veiculoEscolhido = $_GET['veicEscolhido'];
    $db->executar("INSERT INTO agendamentos(aluno_id, carro_id, data_aula, horario_aula) VALUES(1, '$veiculoEscolhido', '$dtEscolhida', '$horario')");
    header("location: ../Usuario/homeUsuario.php?sucess");
}
