<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="pagLogin.css">
</head>
<body>
    <div id="titulo">
        <h1><img class="iconeTitulos" src="../Imgs/icoBandeira.png" alt="icone volante"> Auto escola Automob <img class="iconeTitulos" src="../Imgs/icoBandeira.png" alt="icone volante"></h1>
    </div>
    <div id="painel1" class="painelCentral">
        <form action="" method="POST">
            <h2>AUTOMOB</h2>
            <p><img class="icone" src="../Imgs/icoUsuario.png" alt="Icone usuario"> Acesse seu perfil:</p>
            <input type="email" placeholder="E-mail">
            <input type="password" placeholder="Senha">
            <input id="Logar" type="submit" value="Login">
            <span onclick="trocar(painel1,painel2)">Cadastre-se</span>
        </form>
    </div>
    <div id="painel2"  style="display: none;" class="painelCentral">
        <form action="" method="POST">
            <h2>AUTOMOB</h2>
            <p><img class="icone" src="../Imgs/icoUsuario.png" alt="Icone usuario">Cadastre seu perfil:</p>
            <input type="text" placeholder="Nome">
            <input type="text" placeholder="Sobrenome">
            <input type="date" placeholder="Data de nascimento">
            <input type="text" placeholder="Endereço">
            <input type="number" placeholder="CPF">
            <input type="email" placeholder="E-mail">
            <input type="password" placeholder="Senha">
            <input style="background-color: #3636ca;color: white;" type="submit" value="Solicitar">
            <span onclick="trocar(painel2,painel1)">Voltar</span>
        </form>
    </div>
    <script src="../index.js"></script>
</body>
</html>