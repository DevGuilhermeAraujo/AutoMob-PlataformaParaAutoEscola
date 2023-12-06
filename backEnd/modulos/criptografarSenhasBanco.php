<?php 
    //Utilitario

    include_once "../sessao.php";
    requiredLogin();

    echo "<h3>Criptografar senhas não criptografas do banco.</h3>";

    echo "<p>Logado como usuário: " . ((getNome()!=null)?getNome():"Nenhum") . "</p><br>";

    if(!isset($_GET["exec"])){
        echo "<p>ATENÇÂO: Essa operação não pode ser desfeita.</p>";
        echo "<p>OBS: É de extrema importancia que todas as senhas estejam criptografadas.</p>";
    }

    if(isset($_GET["exec"])){

    include_once "../conexao.php";
        
    $db = new Conexao();
    $result = $db->executar("SELECT id, senha FROM usuarios WHERE LENGTH(senha) < 60",true);

    $c = 0;
    $t = $result->rowCount();
    $result = $result->fetchAll();
    foreach($result as $l){
        $password = password_hash($l['senha'],PASSWORD_DEFAULT);
        if(password_verify($l['senha'],$password)){
            $db->executar("UPDATE usuarios SET senha='$password' WHERE id=".$l['id']);
            echo "<p>Senha de id ".$l['id']." foi criptografada com sucesso."."</p>";
            $c++;
        }else{
             echo "<p>Falha ao criptografar senha do id ".$l['id']."."."</p>";
        }
    }

    echo "<p>Operação concluida, $c de $t senhas foram criptografadas!</p>";

}

?>

<Html>
    <body>
        <?php 
            if(!isset($_GET["exec"])){
        ?>
            <a href="../../Login/pagLogin.php"><button>Voltar</button></a>
        <?php
            }else{
        ?>
            <a href="criptografarSenhasBanco.php"><button>Voltar</button></a>
        <?php
            }
        ?>
        <?php 
            if(!isset($_GET["exec"])){
        ?>
            <a href="?exec"><button>Continuar</button></a>
        <?php
            }
        ?>
    </body>
</Html>