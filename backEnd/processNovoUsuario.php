<?php
include_once "conexao.php";
$db = new Conexao();
if (isset($_GET['aceitar']) || isset($_GET['recusar'])) {
    $idUser = $_GET['idUser'];
    if (isset($_GET['aceitar'])) {
        $db->executar("UPDATE usuarios SET validado = 1 WHERE id = '$idUser'");
        $result = $db->executar("SELECT * FROM usuarios WHERE id = '$idUser' AND validado = 1", true);
        if ($result->rowCount() > 0) {
            header("Location: ../Instrutor/homeInstrutor.php?cadUserSucess");
        } else {
            header("Location: ../Instrutor/homeInstrutor.php?cadUserFailed");
        }
    } elseif(isset($_GET['recusar'])) {
        $db->executar("DELETE FROM usuarios WHERE id = '$idUser'");
        $result = $db->executar("SELECT * FROM usuarios WHERE id = '$idUser'", true);
        if ($result->rowCount() == 0) {
            header("Location: ../Instrutor/homeInstrutor.php?removeUserSucess");
        } else {
            header("Location: ../Instrutor/homeInstrutor.php?removeUserFailed");
        }
    }
}
