<?php
include_once '../BackEnd/sessao.php';
requiredLogin(getDbUtils()->PERMISSION_ALUNO());
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="Usuario.css">
    <script src="../backEnd/script.js"></script>
    <script>
        var msg1;
        function confirmMenssage(text) {
            msg1 = new MsgBox();
            if(document.getElementsByName('email')[0].value == "" || 
            document.getElementsByName('telefone')[0].value == "" || 
            document.getElementsByName('senha')[0].value == "" ||
            document.getElementsByName('confirmSenha')[0].value == "" ||
            document.getElementsByName('senhaAtual')[0].value == ""){
                let msg2 = new MsgBox();
                msg2.showInLine({
                _idName: "msg22",
                _type: msg2.SET_TYPE_TEXT,
                _title: "Campo vazio",
                _menssagem: "Preencha todos os campos!",
                _btnCancelName: "OK",
                _autoDestroy: true
            });
            return;
            }
            document.getElementsByName('email')[0].setAttribute('value',document.getElementsByName('email')[0].value);
            document.getElementsByName('telefone')[0].setAttribute('value',document.getElementsByName('telefone')[0].value);
            document.getElementsByName('senha')[0].setAttribute('value',document.getElementsByName('senha')[0].value);
            document.getElementsByName('confirmSenha')[0].setAttribute('value',document.getElementsByName('confirmSenha')[0].value);
            document.getElementsByName('senhaAtual')[0].setAttribute('value',document.getElementsByName('senhaAtual')[0].value);
            msg1.showInLine({
                _idName: "msg11",
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
        <h1>Editar meu perfil</h1>
        <a href="homeUsuario.php">Voltar</a>
    </div>
    <div id="edt">
        <img src="../Imgs/icoPerfil.png" alt="foto perfil">
        <form id="formEdit" action="../backEnd/processEditarUsuario.php?editarUsuario" method="POST" onsubmit="return (msg1.returnBtnClicked == MsgBox.BTN_OK)">
            <input type="email" name="email" placeholder="E-mail ?">
            <input type="text" id="telefone" name="telefone" placeholder="Telefone ?" oninput="maskTelefone(this)" maxlength="14" minlength="14">
            <input type="password" name="senha" placeholder="Nova senha">
            <input type="password" name="confirmSenha" placeholder="Repita a nova senha">
            <input type="password" name="senhaAtual" placeholder="Digite a senha atual">
            <input style="background-color:#02024b;color:white;border: 5px solid white" type="submit" onclick="confirmMenssage('Editar dados de usuário?');" value="Confirmar dados">
        </form>
    </div>
</body>

</html>