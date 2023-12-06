<?php
include_once "../backEnd/sessao.php";
requiredLogin(getDbUtils()->PERMISSION_INSTRUTOR());
if (isset($_GET['idCarro'])) {
    $idCarro = $_GET['idCarro'];
    $result = getDb()->executar("SELECT marca, modelo, ano, placa, capacidade_passageiros AS capacidade FROM carros WHERE id = '$idCarro'", true);
    foreach ($result as $c) {
        $marca = $c['marca'];
        $modelo = $c['modelo'];
        $ano = $c['ano'];
        $placa = $c['placa'];
        $capacidade = $c['capacidade'];
    }
}
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
        <form action="../backEnd/processEditarCarro.php?editarcarro" method="POST">
            <input type="text" name="id" value="<?= $idCarro ?>" readonly>
            <input type="text" name="marca" value="<?= $marca ?>" required>
            <input type="text" name="modelo" value="<?= $modelo ?>" required>
            <input type="text" name="ano" value="<?= $ano ?>" required>
            <input type="text" name="placa" value="<?= $placa ?>" required>
            <input type="text" name="capacidade" value="<?= $capacidade ?>" required>
            <input id="cada" type="submit" value="Cadastrar">
        </form>
    </div>
</body>

</html>