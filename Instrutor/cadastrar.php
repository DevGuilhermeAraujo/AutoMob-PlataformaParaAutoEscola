<?php
include_once "../backEnd/conexao.php";
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
</head>

<body>
    <div class="Inicio">
        <h1>Cadastrar</h1>
        <a href="homeInstrutor.php">Voltar</a>
    </div>
    <div class="cad">
        <h2>Cadastre um novo veículo</h2>
        <form action="../backEnd/cadastro/processCadastroCarros.php?cadastroCarro" method="POST">
            <input type="text" name="marca" placeholder="Marca" required>
            <input type="text" name="modelo" placeholder="Modelo" required>
            <input type="text" name="ano" placeholder="Ano" required>
            <input type="text" name="placa" placeholder="Placa" required>
            <input type="text" name="capacidade" placeholder="Capacidade de passageiros" required>
            <input id="cada" type="submit" value="Cadastrar">
        </form>
    </div>
    <div class="cad">
        <h2>Aceite um novo aluno</h2>
        <?php
        $result = $db->executar("SELECT id, nome, cpf, endereco FROM usuarios WHERE tipo = 3 AND validado = 0");
        foreach ($result as $usuario) {
            $idUser = $usuario['id'];
            $nome = $usuario['nome'];
            $cpf = $usuario['cpf'];
            $endereco = $usuario['endereco'];
        ?>
            <div class="Usu">
                <div class="ico">
                    <img src="../Imgs/icoUsuario.png" alt="icone usuario">
                </div>
                <div class="infor">
                    <?php
                    echo "<p>$nome</p>";
                    echo "<p>$cpf</p>";
                    echo "<p>$endereco</p>";
                    echo "<a href='../backEnd/processNovoUsuario.php?idUser=$idUser&aceitar'><button style='background-color: green;'>Aceitar</button></a>";
                    echo "<a href='../backEnd/processNovoUsuario.php?idUser=$idUser&recusar'><button style='background-color: red;'>Recusar</button></a>";
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>