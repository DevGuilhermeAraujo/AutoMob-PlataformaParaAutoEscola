<?php
include_once "../backEnd/sessao.php";
requiredLogin(getDbUtils()->PERMISSION_INSTRUTOR());
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aceitos</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="Cadastrados.css">
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
                //_btnOkHref: "../backEnd/processNovoUsuario.php?idUser=" + id + "&recusar",
                _btnOkAction: "sentAjaxGET('../backEnd/processNovoUsuario.php', 'idUser=" + id + "&recusar',update);",
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
                //_btnOkHref: "../backEnd/processNovoUsuario.php?idUser=" + id + "&" + value,
                _btnOkAction: "sentAjaxGET('../backEnd/processNovoUsuario.php', 'idUser=" + id + "&" + value + "',update);",
                _btnCancelName: "Não",
                _autoDestroy: true
            });
        }

        /**@param {string} html  */
        function update(html) {
            //let compile = html.match(new RegExp(`<div class="Agenda">([\s\S]*?)*</div>`, "g")); 
            let getDiv = document.createElement('div');
            getDiv.innerHTML = html;
            getDiv = getDiv.querySelector('.Agenda');

            let atualDiv = document.querySelector('.Agenda');

            // Substituir a div existente pela nova div
            if(atualDiv && getDiv) {
                atualDiv.parentNode.replaceChild(getDiv, atualDiv);
            } else {
                console.error('Div existente ou nova div não encontrada.');
            }
        }
    </script>
</head>

<body>
    <!--
<div class="Inicio">
        <h1>Olá, seja bem vindo <span></span></h1>
    </div>
    -->
    <?= HTML::getInicioPage() ?>

    <div class="Nav">
        <a href="../Login/pagLogin.php"><img class="iconeNav" src="../Imgs/icoSair.png" alt="icone sair"> Voltar</a>
        <a href="../Cadastrados/Veiculos.php"><img class="iconeNav" src="../Imgs/icoVolante.png" alt="icone veículos"> Veículos</a>
        <a href="../Instrutor/cadastrar.php"><img class="iconeNav" src="../Imgs/icoCadastro.png" alt="icone de cadastro">Cadastrar</a>
    </div>
    <div class="Agenda">
        <h2>Alunos cadastrados</h2>
        <div class="titulos">
            <p>
                <span>CPF</span>
                <span>Nome</span>
                <span>Data de Nascimento</span>
                <span>Idade</span>
                <!--<span>Validado</span>-->
                <span>Remover</span>
            </p>
        </div>
        <?php
        $result = getDb()->executar("SELECT id, cpf, nome, data_nascimento, idade, validado FROM view_alunos", true);
        $id = getId();
        if ($result->rowCount() > 0) {
            $result = $result->fetchAll();
            foreach ($result as $i) {
        ?>
                <p>
                    <span><?= $i['cpf'] ?></span>
                    <span><?= $i['nome'] ?></span>
                    <span><?= $i['data_nascimento'] ?></span>
                    <span><?= $i['idade'] ?></span>
                    <!--<button <?php if (($i['validado'] == 0)) { ?> onclick="confirmMenssage(<?= $i['id'] ?>,'Aceitar usuário <?= $i['nome'] ?> ?','aceitar');" <?php } ?> class="<?= ($i['validado'] == 1) ? "buttonPositive" : "" ?>"><?= ($i['validado'] == 1) ? "Sim" : "Não" ?></button>-->
                    <button onclick="removerCadastroMenssage(<?= $i['id'] ?>,'<?= $i['nome'] ?>');">X</button>
                </p>
        <?php
            }
        } else {
            echo "<p><span> Não há horários marcados para você </span></p>";
        }
        ?>
        <!--
        <p>
            <span>111.111.111-11</span>
            <span>Joao das Dores</span>
            <span>20</span>
            <span>20</span>
            <button>Não</button>
            <button>X</button>
        </p>
        <p>
            <span></span>
            <span></span>
            <span></span>
            <button>X</button>
        </p>
        <p>
            <span></span>
            <span></span>
            <span></span>
            <button>X</button>
        </p>
        -->
    </div>
</body>

</html>