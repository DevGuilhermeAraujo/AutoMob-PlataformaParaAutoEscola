<?php 

include_once "../sessao.php";
include_once "../conexao.php";
include_once "../modulos/dbValidateUser.php";

$userValid = new ValidaUsuario(new Conexao());

$valid = $userValid->validaUser($_POST["User"],$_POST["Pass"]);

if(!$valid){
    if($userValid->errorCode != 0){
        header("Location: ../../Login/pagLogin.php?ERROR=$userValid->errorCode");
        exit();
    } 
    header("Location: ../../Login/pagLogin.php?invalidLogin");
    exit();
}

//Criar sessão
setSessionVars($userValid);

header("Location: ../../Login/pagLogin.php");

?>