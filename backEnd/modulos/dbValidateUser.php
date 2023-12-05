<?php

class ValidaUsuario
{

    private $db;
    public $errorCode;
    private $id;
    private $nome;
    private $cpf;


    function __construct(Conexao $db)
    {
        $this->db = $db;
        $this->errorCode = 0;
        $this->id = null;
        $this->nome = null;
        $this->cpf = null;
    }

    /**
     * @return bool
     */
    public function validaUser(string $usuario, string $senha)
    {
        //Regex cpf, formato: XXX.XXX.XXX-XX
        if (!preg_match("(^\d{3}\x2E\d{3}\x2E\d{3}\x2D\d{2}$)",$usuario)) {
            return false;
        }
        if ($senha == "") {
            return false;
        }

        //Validar com o banco
        if ($this->db->errorCode != 0) {
            //Houve um erro de conexão
            $this->errorCode = 1;
            return false;
        }

        //Buscar usuário e dados
        $userValid = $this->db->executar("SELECT id, nome, senha FROM usuarios WHERE cpf = :cpf", true, false);
        $userValid->bindParam(":cpf", $usuario);
        $userValid->execute();
        $result = $userValid->fetchAll();
        $userValid = $userValid->rowCount();
        if (!$userValid) {
            return false;
        }
        
        //Valida senha
        if(!password_verify($senha, $result[0]['senha']) && $result[0]['senha'] != $senha){ // IMPORTANTE -> A segunda parte do '&&' (E) deve ser removida após a padronização da criptografia!
        //if (!password_verify($senha, $result[0]['senha'])) {
            return false;
        }
        
        $this->id = $result[0]['id'];
        $this->nome = $result[0]['nome'];
        $this->cpf = $usuario;
        
        return true;
    }

    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function getDb(){
        return $this->db;
    }
}
