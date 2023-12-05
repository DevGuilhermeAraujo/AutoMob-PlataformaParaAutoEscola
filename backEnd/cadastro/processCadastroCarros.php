<?php
include_once "../sessao.php";
if (isset($_GET['cadastroCarro'])) {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];
    $capacidade = $_POST['capacidade'];
    $idInstrutor = getId();
    getDb()->executar("INSERT INTO carros(marca, modelo, ano, placa, capacidade_passageiros) VALUES('$marca', '$modelo', '$ano', '$placa', '$capacidade')");
    $result = getDb()->executar("SELECT id FROM carros WHERE placa = '$placa'");
    $idCarro = $result[0][0];
    $result = getDb()->executar("SELECT id FROM carros WHERE placa = '$placa'", true);
    if ($result->rowCount() == 0) {
        header("Location: ../../Instrutor/homeInstrutor.php?cadCarFailed");
        exit();
    } else {
        getDb()->executar("INSERT INTO log_instrutores_carros(Instrutor_id, carro_id) VALUES('$idInstrutor', '$idCarro')", true);
        header("Location: ../../Instrutor/homeInstrutor.php?cadCarSucess");
        exit();
    }
} else {
    header("Location: ../../Instrutor/homeInstrutor.php");
    exit();
}
