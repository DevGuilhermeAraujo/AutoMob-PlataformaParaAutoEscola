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
</head>

<body>
    <div class="Inicio">
        <h1>Editar meu perfil</h1>
        <a href="homeUsuario.php">Voltar</a>
    </div>
    <div id="edt">
        <img src="../Imgs/icoPerfil.png" alt="foto perfil">
        <form action="../backEnd/processEditarUsuario.php?editarUsuario" method="POST">
            <input type="email" name="email" placeholder="E-mail ?">
            <input type="text" id="telefone" name="telefone" placeholder="Telefone ?" oninput="maskTelefone(this)" maxlength="14" minlength="14">
            <input type="password" name="senha" placeholder="Nova senha">
            <input type="password" name="confirmSenha" placeholder="Repita a nova senha">
            <input type="password" name="senhaAtual" placeholder="Digite a senha atual">
            <input style="background-color:#02024b;color:white;border: 5px solid white" type="submit" value="Confirmar dados">
        </form>
    </div>
</body>

</html>