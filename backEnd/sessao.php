<?php
include_once "conexao.php";
include_once "modulos/dbUtils.php";
include_once "modulos/dbValidateUser.php";
include_once "modulos/permissionManager.php";
session_start();
//Constantes de ambiente
//Legado - Remover posteriormente
const SESSION_USER_ID = "UserId";
const SESSION_USERNAME = "UserName";
const SESSION_CPF = "UserCpf";

class Sessao
{

    function __construct()
    {
    }

    /** 
     * @return int
     */
    function getId()
    {
        return getId();
    }

    /** 
     * @return string
     */
    function getNome()
    {
        return getNome();
    }

    /** 
     * @return string
     */
    function getCpf()
    {
        return getCpf();
    }

    /** 
     * @return int
     */
    function getTipoInt()
    {
        return getTipoInt();
    }

    /** 
     * @return string
     */
    function getTipoStr()
    {
        return getTipoStr();
    }

    function getDbUtils()
    {
        return getDbUtils();
    }

    function destroy()
    {
        return destroySession();
    }

    function logued(?int $tipoRequest = null)
    {
        return logued($tipoRequest);
    }
}

//Funções para o Front-End

function setSessionVars(ValidaUsuario $user)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION[SESSION_USER_ID] = $user->getId();
    $_SESSION[SESSION_USERNAME] = $user->getNome();
    $_SESSION[SESSION_CPF] = $user->getCpf();
}

function verifSessionVars()
{
    if (isset($_SESSION[SESSION_USER_ID]) && isset($_SESSION[SESSION_USERNAME]) && isset($_SESSION[SESSION_CPF])) {
        return true;
    }
    return false;
}

function logued(?int $tipoRequest = null)
{
    if (session_status() === PHP_SESSION_ACTIVE && verifSessionVars()) {
        if ($tipoRequest != null)
            if (getTipoInt() != $tipoRequest) {
                return false;
            }
        return true;
    }
    return false;
}

function destroySession()
{
    unset($_SESSION);
    session_destroy();
}

/** 
 * @return Conexao
 */
function getDb()
{
    return new Conexao();
}

/** 
 * @return dbUtils
 */
function getDbUtils()
{
    return new dbUtils(getDb());
}


/** 
 * @return int
 */
function getId()
{
    return $_SESSION[SESSION_USER_ID];
}

/** 
 * @return string
 */
function getNome()
{
    return $_SESSION[SESSION_USERNAME];
}

/** 
 * @return string
 */
function getCpf()
{
    return $_SESSION[SESSION_CPF];
}

/** 
 * @return int
 */
function getTipoInt()
{
    try {
        return getDb()->executar("SELECT tipo FROM usuarios WHERE id = '" . getId() . "'")[0][0];
    } catch (Exception $e) {
        //throw new ErrorException($e);
    }
    return null;
}

/** 
 * @return string
 */
function getTipoStr()
{
    try {
        return getDb()->executar("SELECT t.nomeTipo FROM usuarios as u JOIN tipos as t ON u.tipo = t.id WHERE id = '" . getId() . "'")[0][0];
    } catch (Exception $e) {
        //throw new ErrorException($e);
    }
    return null;
}

function requiredLogin(?Int $permission = null, ?String $URL = null)
{
    (new permissonManager(new Sessao()))->requeridLogin($permission, $URL);
}

function logout()
{
    //Sair do usuario (deslogar)
    destroySession();
}

function redirectByPermission()
{
    (new permissonManager(new Sessao))->redirect();
}


//Menssagem Pop-up com/sem background
const MSG_POSITIVE = 1;
const MSG_NEGATIVE = 2;
const MSG_POSITIVE_BG = 3;
const MSG_NEGATIVE_BG = 4;

function msg(int $type, string $message, ?string $class = "", ?string $style = "", ?string $id = "", ?int $hideTimer = 0, ?string $importJsUri = null)
{
    switch ($type) {
        case 1:
            //Menssangem positiva
            echo '<span id="' . $id . '" class="msgV ' . $class . '" style="' . $style . '">' . $message . '</span>';
            break;
        case 2:
            //Menssagem negativa
            echo '<span id="' . $id . '" class="msgN ' . $class . '" style="' . $style . '">' . $message . '</span>';
            break;
        case 3:
            //Menssagem positiva com background
            echo '<span id="' . $id . '" class="msgV-bg ' . $class . '" style="' . $style . '">' . $message . '</span>';
            break;
        case 4:
            //Menssagem negativa com background
            echo '<span id="' . $id . '" class="msgN-bg ' . $class . '" style="' . $style . '">' . $message . '</span>';
            break;
        default:
            throw new Exception('Entrada invalida na função msg().');
    }

    if (!$hideTimer == 0) {
        //Se a menssagem vai desaparecer
        //Tenta inserir o javascript caso não esteja na pagina (melhorar depois)
        if ($importJsUri == null) {
            //Tenta importar de um caminho padrão
            echo '<script src="../BackEnd/script.js"></script>';
        } else {
            //Importa de um caminho determinado
            echo '<script src="' . $importJsUri . '"></script>';
        }
        //Chamar o metodo javascript para interação no lado cliente
        echo "<script>deleteMsg($hideTimer,$id);</script>";
    }
}

function redirectPOST(string $url, string $values, ?string $importJsUri = "../BackEnd/script.js")
{
    echo "<script src='$importJsUri'></script>";
    //Chamar o metodo javascript para interação no lado cliente
    echo "<script>redirectPOSTAjax('$url', '$values');</script>";
}
