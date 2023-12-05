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
$tipo = $_POST['tipo'];
if ($db->errorCode === 0) {
    $db->executar("INSERT INTO usuarios(nome, cpf, data_nascimento, endereco, telefone, email, senha, tipo) VALUES('$nomeCompleto', '$cpf', '$dtNascimento', '$endereco', '$telefone', '$email', '$senha', '$tipo')");
    $result = $db->executar("SELECT * FROM usuarios WHERE cpf = '$cpf'", true);
    if ($result->rowCount() > 0) {
        header("Location: ../../Login/pagLogin.php?cadSucess");
        exit();
    } else {
        header("location:../Login/pagLogin.php?ERROR");
    }
}
