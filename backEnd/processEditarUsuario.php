<?php
include_once '../BackEnd/sessao.php';
requiredLogin(getDbUtils()->PERMISSION_ALUNO());
$idUser = getId();
if (isset($_GET['editarUsuario'])) {
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confirmSenha = $_POST['confirmSenha'];
    $senhaAtual = $_POST['senhaAtual'];
    if ($senha == $confirmSenha) {
        $result = getDb()->executar("SELECT * FROM usuarios WHERE senha = '$senhaAtual'", true);
        if ($result->rowCount() > 0) {
            $result = getDb()->executar("UPDATE usuarios SET telefone = '$telefone', email = '$email', senha = '$senha' WHERE id = '$idUser'", true);
            if ($result->rowCount() > 0) {
                header("Location: ../Instrutor/homeInstrutor.php?editUserSucess");
            }
        } else {
            header("Location: ../Instrutor/homeInstrutor.php?editUserFailed");
        }
    } else {
        header("Location: ../Instrutor/homeInstrutor.php?senhainvalida");
    }
}
