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
    <script>
        function removerCadastroMenssage(id, user) {
            let msg1 = new MsgBox();
            msg1.showInLine({
                _idName: "msg11",
                _type: msg1.SET_TYPE_TEXT,
                _title: "Excluir usuário?",
                _menssagem: "Tem certeza que deseja excluir o usuário " + user + "?",
                _btnOkName: "Sim",
                _btnOkHref: `../backEnd/processNovoUsuario.php?idUser=${id}&recusar`,
                _btnCancelName: "Cancelar",
                _autoDestroy: true
            });
        }

        function confirmMenssage(id, text, value) {
            let msg2 = new MsgBox();
            msg2.showInLine({
                _idName: "msg22",
                _type: msg2.SET_TYPE_TEXT,
                _title: "Confirmação",
                _menssagem: text,
                _btnOkName: "Sim",
                _btnOkHref: `../backEnd/processNovoUsuario.php?idUser=${id}&aceitar`,
                _btnCancelName: "Não",
                _autoDestroy: true
            });
        }
    </script>
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
        //$result = $db->executar("SELECT id, nome, cpf, endereco FROM usuarios WHERE tipo = 3 AND validado = 0");
        $result = $db->executar("SELECT id, nome, cpf, idade, endereco FROM view_alunos WHERE validado = 0", true);
        if ($result->rowCount() > 0) {
            foreach ($result as $usuario) {
                $idUser = $usuario['id'];
                $nome = $usuario['nome'];
                $cpf = $usuario['cpf'];
                $idade = $usuario['idade'];
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
                        echo "<p>$idade anos</p>";
                        echo "<p>$endereco</p>";
                        //echo "<a href='../backEnd/processNovoUsuario.php?idUser=$idUser&aceitar'><button style='background-color: green;'>Aceitar</button></a>";
                        //echo "<a href='../backEnd/processNovoUsuario.php?idUser=$idUser&recusar'><button style='background-color: red;'>Recusar</button></a>";
                        echo "<a onclick=\"confirmMenssage(".$idUser.",'Aceitar usuário ".$nome."?','aceitar');\" ><button style='background-color: green;'>Aceitar</button></a>";
                        echo "<a onclick=\"removerCadastroMenssage(".$idUser.",'".$nome."');\" ><button style='background-color: red;'>Recusar</button></a>";
                        ?>
                    </div>
                </div>
        <?php
            }
        }else{
            echo "<b>Nenhum aluno solicitou cadastro por enquanto</b>";
        }
        ?>
    </div>
</body>
</html>