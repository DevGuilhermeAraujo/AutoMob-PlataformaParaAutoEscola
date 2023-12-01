<?php
include_once "../conexao.php";
$db = new Conexao();

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$nomeCompleto = $nome . " " . $sobrenome;
$dtNascimento = $_POST['dtNascimento'];
$endereco = $_POST['endereco'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$senha = $_POST['senha'];
if ($db->errorCode === 0) {
    $db->executar("INSERT INTO usuariosnovalids(nome, cpf, data_nascimento, endereco, telefone, email, tipo, senha) VALUES('$nomeCompleto', '$cpf', '$dtNascimento', '$endereco', '$telefone', '$email', 1, '$senha')");
    $result = $db->executar("SELECT * FROM usuariosnovalids WHERE cpf = '$cpf'", true);
    if ($result->rowCount() > 0) {
        header("Location: ../../Login/pagLogin.php?cadSucess");
        exit();
    } else {
        header("location:../Login/pagLogin.php?ERROR");
    }
}
