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
        <form>
            <input type="text" placeholder="Modelo">
            <input type="text" placeholder="Marca">
            <input type="text" placeholder="Ano">
            <input type="text" placeholder="Placa">
            <input type="password" placeholder="Senha">
            <input id="cada" type="submit" value="Cadastrar">
        </form>
    </div>
    <div class="cad">
        <h2>Aceite um novo aluno</h2>
        <div class="Usu">
            <div class="ico">
                <img src="../Imgs/icoUsuario.png" alt="icone usuario">
            </div>
            <div class="infor">
                <p>Nome</p>
                <p>Localização</p>
                <button style="background-color: green;">Aceitar</button>
                <button style="background-color: red;">Recusar</button>
            </div>
        </div>
        <div class="Usu">
            <div class="ico">
                <img src="../Imgs/icoUsuario.png" alt="icone usuario">
            </div>
            <div class="infor">
                <p>Fulano de tal fazendo teste</p>
                <p>Vila de Uberaba Centro da Guarana</p>
                <button style="background-color: green;">Aceitar</button>
                <button style="background-color: red;">Recusar</button>
            </div>
        </div>
    </div>
</body>
</html>