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

    <!--Este painel deverá ser apagado ao final do desenvolvimento-->
    <div class="painelCentral">
        <h2>Area destinada a testes dos cadastros</h2>
        <div class="testes">
            <h2>Carros cadastrados</h2>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reiciendis atque ullam sit aliquid at totam nam, iste numquam nobis quae consequatur quaerat eius enim officia nostrum facilis minima vitae iusto.</p>
        </div>
        <div class="testes">
            <h2>Alunos cadastrados</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione laudantium, aliquid, sit illo quod molestiae aut nesciunt omnis similique qui quisquam, deserunt modi dignissimos reprehenderit quibusdam aspernatur repellat minus quae!</p>
        </div>
    </div>
    <script src="../index.js"></script>
</body>
</html>