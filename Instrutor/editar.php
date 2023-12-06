<?php
include_once "../backEnd/sessao.php";
requiredLogin(getDbUtils()->PERMISSION_INSTRUTOR());
$db = new Conexao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="Instrutor.css">
    <script src="../backEnd/script.js"></script>
    </head>
<body>
    <div class="Inicio">
        <h1>Editar</h1>
        <a href="homeInstrutor.php">Voltar</a>
    </div>
    <div class="cad">
        <h2>Edite o veículo desejado</h2>
        <form action="../backEnd/cadastro/processCadastroCarros.php?cadastroCarro" method="POST">
            <input type="text" name="marca" placeholder="Marca" required>
            <input type="text" name="modelo" placeholder="Modelo" required>
            <input type="text" name="ano" placeholder="Ano" required>
            <input type="text" name="placa" placeholder="Placa" required>
            <input type="text" name="capacidade" placeholder="Capacidade de passageiros" required>
            <input id="cada" type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>