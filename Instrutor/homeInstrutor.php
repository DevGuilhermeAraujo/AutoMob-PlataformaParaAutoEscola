<?php 
include_once "../backEnd/sessao.php";
requiredLogin(getDbUtils()->PERMISSION_INSTRUTOR());  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeInstrutor</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="Instrutor.css">
</head>
<body>
    <div class="Inicio">
        <h1>Olá, seja bem vindo <span><?= getNome() ?> <!--Aqui deverá aparecer o nome do usuário--></span></h1>
    </div>
    <div class="Nav">
        <a href="../backEnd/logout.php"><img class="iconeNav" src="../Imgs/icoSair.png" alt="icone sair"> Voltar</a>
        <a href=""><img class="iconeNav" src="../Imgs/icoVolante.png" alt="icone veículos"> Veículos</a>
        <a href=""><img class="iconeNav" src="../Imgs/icoUsuario.png" alt="icone usuários"> Alunos</a>
        <a href="cadastrar.php"><img class="iconeNav" src="../Imgs/icoCadastro.png" alt="icone de cadastro">Cadastrar</a>
    </div>
    <div class="Agenda">
            <h2>Meus horários</h2>
            <div class="titulos">
                <p>
                    <span>Data</span>
                    <span>Carro</span>
                    <span>Placa</span>
                    <span>Professor</span>
                    <span>Remover</span>
                </p>
            </div>
            <p>
                <span>01/01/0001 12:00</span>
                <span>Chevrolet/Camaro</span>
                <span>abcd-1234</span>
                <span>Professor</span>
                <button>X</button>
            </p>
            <p>
                <span>01/01/0001 12:00</span>
                <span>Chevrolet/Camaro</span>
                <span>abcd-1234</span>
                <span>Professor</span>
                <button>X</button>
            </p>
            <p>
                <span>01/01/0001 12:00</span>
                <span>Chevrolet/Camaro</span>
                <span>abcd-1234</span>
                <span>Professor</span>
                <button>X</button>
            </p>
        </div>
</body>
</html>