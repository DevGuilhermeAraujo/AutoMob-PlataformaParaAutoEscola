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
        if ($result->rowCount() > 0 || password_verify($senhaAtual,getDb()->executar("SELECT senha FROM usuarios WHERE id = '$idUser'")[0][0])) {
            $result = getDb()->executar("UPDATE usuarios SET telefone = '$telefone', email = '$email', senha = '".password_hash($senha,PASSWORD_DEFAULT)."' WHERE id = '$idUser'", true);
            if ($result->rowCount() > 0) {
                header("Location: ../Usuario/homeUsuario.php?editUserSucess");
            }
        } else {
            header("Location: ../Usuario/homeUsuario.php?senhainvalida");
        }
    } else {
        header("Location: ../Usuario/homeUsuario.php?editUserFailed");
    }
}
