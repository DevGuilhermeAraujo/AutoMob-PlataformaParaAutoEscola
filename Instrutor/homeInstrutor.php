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
    <script src="../backEnd/script.js"></script>
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
        <?php
        $result = getDb()->executar("SELECT a.id as id, DATE_FORMAT(a.data_aula, '%d/%m/%Y') as data_aula, a.horario_aula as horario_aula, c.marca as marca, c.placa as placa, u.nome as nome FROM agendamentos as a JOIN carros as c ON c.id = a.carro_id JOIN usuarios as u ON u.id = a.Instrutor_id WHERE a.Instrutor_id = :id", true, false);
        $id = getId();
        $result->bindParam(":id", $id);
        $result->execute();
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll();

            foreach ($result as $i) {
        ?>
                <p>
                    <span><?= $i['data_aula']." ".$i['horario_aula'] ?></span>
                    <span><?= $i['marca'] ?></span>
                    <span><?= $i['placa'] ?></span>
                    <span><?= $i['nome'] ?></span>
                    <button onclick='let msg1 = new MsgBox(); msg1.showInLine({_idName: "msg11", _type: msg1.SET_TYPE_TEXT ,_title: "Excluir horário?", _menssagem: "Tem certeza que deseja excluir este horário?", _btnOkName: "Sim", _btnOkHref: "../backEnd/processRemoverAgendamento.php?idAgendamento=<?= $i["id"] ?>", _btnCancelName: "Cancelar", _autoDestroy: true});'>X</button>
                </p>
        <?php
            }
        }else{
            echo "<p><span> Não há horários marcados para você </span></p>";
        }
        ?>
        <!--
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
        -->
    </div>
</body>

</html>