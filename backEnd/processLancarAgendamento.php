<?php
include_once '../BackEnd/sessao.php';
$idUser = getId();
if (isset($_GET['horario']) && isset($_GET['dtEscolhida']) && isset($_GET['veicEscolhido'])) {
    $horario = $_GET['horario'];
    $dtEscolhida = $_GET['dtEscolhida'];
    $veiculoEscolhido = $_GET['veicEscolhido'];
    getDb()->executar("INSERT INTO agendamentos(aluno_id, Instrutor_id, carro_id, data_aula, horario_aula) VALUES('$idUser', (SELECT Instrutor_id FROM log_instrutores_carros WHERE carro_id = '$veiculoEscolhido'),'$veiculoEscolhido', '$dtEscolhida', '$horario')");
    header("location: ../Usuario/homeUsuario.php?sucess");
}
