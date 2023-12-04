<?php
include_once "../conexao.php";
$db = new Conexao();
if (isset($_GET['cadastroCarro'])) {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];
    $capacidade = $_POST['capacidade'];
    $db->executar("INSERT INTO carros(marca, modelo, ano, placa, capacidade_passageiros) VALUES('$marca', '$modelo', '$ano', '$placa', '$capacidade')");
    $result = $db->executar("SELECT * FROM carros WHERE placa = '$placa'", true);
    if ($result->rowCount() == 0) {
        header("Location: ../../Instrutor/homeInstrutor.php?cadCarFailed");
        exit();
    } else {
        header("Location: ../../Instrutor/homeInstrutor.php?cadCarSucess");
        exit();
    }
} else {
    header("Location: ../../Instrutor/homeInstrutor.php");
    exit();
}
