<?php 

const SESSION_VAR = "SESSIONDATA";

function session(){
    return $_SESSION[SESSION_VAR];
}

class sessao{

    private int $id;
    private string $nome;
    private string $cpf;

    /**
     * Cria a sessão  se ela não existir ou sobrescreve
     * @param int $id
     * @param string $nome
     * @param string $cpf
     */
    function __construct($id, $nome, $cpf)
    {
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }

        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;

        $_SESSION[SESSION_VAR] = $this;
    }

    public static function getSession(){
        return $_SESSION[SESSION_VAR];
    }

    /**
     * Destroi a sessão se ela existir
     */
    public function destroy(){
        if(session_status() === PHP_SESSION_ACTIVE){
            unset($_SESSION);
            session_unset();
            session_destroy();
        }
        //$this = null;
    }


    /** 
     * @return int
    */
    public function getid(){
        return $this->id;
    }

    /** 
     * @return string
    */
    public function getNome(){
        return $this->nome;
    }

    /** 
     * @return string
    */
    public function getCpf(){
        return $this->cpf;
    }


}

?>