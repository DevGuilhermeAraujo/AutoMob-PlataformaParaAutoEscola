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
    <script>
        var msg1;
        function confirmMenssage(text) {
            document.getElementsByName('marca')[0].setAttribute('value',document.getElementsByName('marca')[0].value);
            document.getElementsByName('modelo')[0].setAttribute('value',document.getElementsByName('modelo')[0].value);
            document.getElementsByName('ano')[0].setAttribute('value',document.getElementsByName('ano')[0].value);
            document.getElementsByName('placa')[0].setAttribute('value',document.getElementsByName('placa')[0].value);
            document.getElementsByName('capacidade')[0].setAttribute('value',document.getElementsByName('capacidade')[0].value);
            msg1 = new MsgBox();
            msg1.showInLine({
                _idName: "msg22",
                _type: msg1.SET_TYPE_TEXT,
                _title: "Confirmação",
                _menssagem: text,
                _btnOkName: "Sim",
                _btnOkAction: "document.querySelector('#formEdit').submit();",
                _btnCancelName: "Não",
                _autoDestroy: true
            });
        }
        </script>
</head>

<body>
    <div class="Inicio">
        <h1>Editar</h1>
        <a href="homeInstrutor.php">Voltar</a>
    </div>
    <div class="cad">
        <h2>Edite o veículo desejado</h2>
        <form id="formEdit" action="../backEnd/processEditarCarro.php?editarcarro" method="POST" onsubmit="return (msg1.returnBtnClicked == MsgBox.BTN_OK)">
            <input type="text" name="id" value="<?= $idCarro ?>" readonly>
            <input type="text" name="marca" value="<?= $marca ?>" required>
            <input type="text" name="modelo" value="<?= $modelo ?>" required>
            <input type="text" name="ano" value="<?= $ano ?>" required>
            <input type="text" name="placa" value="<?= $placa ?>" required>
            <input type="text" name="capacidade" value="<?= $capacidade ?>" required>
            <input id="cada" type="submit" onclick="confirmMenssage('Editar dados do veículo?');" value="Cadastrar">
        </form>
    </div>
</body>

</html>