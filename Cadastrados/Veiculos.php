<?php
include_once "../backEnd/sessao.php";
requiredLogin(getDbUtils()->PERMISSION_INSTRUTOR());
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veiculos</title>
    <link rel="stylesheet" href="../index.css">
    <script src="../backEnd/script.js"></script>
    <script>
        function removerCadastroMenssage(id, text) {
            let msg1 = new MsgBox();
            msg1.showInLine({
                _idName: "msg11",
                _type: msg1.SET_TYPE_TEXT,
                _title: "Excluir veículo?",
                _menssagem: "Tem certeza que deseja excluir o veículo " + text + "?",
                _btnOkName: "<i>Excluir</i>",
                _btnOkAction: "sentAjaxGET('../backEnd/processRemoverCarro.php', 'idCarro=" + id + "');",
                _btnCancelName: "<i>Cancelar</i>",
                _autoDestroy: true
            });
        }
    </script>
</head>

<body>
    <?= HTML::getInicioPage() ?>
    <div class="Nav">
        <a href="../Login/pagLogin.php"><img class="iconeNav" src="../Imgs/icoSair.png" alt="icone sair"> Voltar</a>
        <a href="../Cadastrados/alunosAceitos.php"><img class="iconeNav" src="../Imgs/icoUsuario.png" alt="icone usuários"> Alunos</a>
        <a href="../Instrutor/cadastrar.php"><img class="iconeNav" src="../Imgs/icoCadastro.png" alt="icone de cadastro">Cadastrar</a>
    </div>
    <div class="Agenda">
        <h2>Carros cadastrados</h2>
        <div class="titulos">
            <p>
                <span>Marca</span>
                <span>Modelo</span>
                <span>Ano</span>
                <span>Placa</span>
                <span>Editar</span>
                <span>Remover</span>
            </p>
        </div>
        <?php
        $result = getDb()->executar("SELECT id, marca, modelo, ano, capacidade_passageiros AS capacidade, placa FROM carros", true);
        $id = getId();
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll();
            foreach ($result as $i) {
        ?>
                <p>
                    <span><?= $i['marca'] ?></span>
                    <span><?= $i['modelo'] ?></span>
                    <span><?= $i['ano'] ?></span>
                    <span><?= $i['placa'] ?></span>
                    <a href="../Instrutor/editar.php?idCarro=<?= $i['id'] ?>"><button>E</button></a>
                    <button onclick="removerCadastroMenssage(<?= $i['id'] ?>,'<?= ($i['marca'].' '.$i['modelo']) ?>');">X</button>
                </p>
        <?php
            }
        } else {
            echo "<p>Não há veículos cadastrados</p>";
        }
        ?>

    </div>
</body>

</html>