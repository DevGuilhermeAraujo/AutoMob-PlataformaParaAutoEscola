<?php
include_once "../backEnd/sessao.php";
requiredLogin(getDbUtils()->PERMISSION_INSTRUTOR());
if(isset($_GET['editarcarro'])){
    $idCarro = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];
    $capacidade = $_POST['capacidade'];
    $result = getDb()->executar("UPDATE carros SET marca = '$marca', modelo = '$modelo', ano = '$ano', placa = '$placa', capacidade_passageiros = '$capacidade' WHERE id = '$idCarro'", true);
    if ($result->rowCount() > 0) {
        header("Location: ../Instrutor/homeInstrutor.php?editCarSucess");
        exit();
    } else {
        header("Location: ../Instrutor/homeInstrutor.php?editCarFailed");
        exit();
    }
}
?>