<?php

class validaUsuario
{

    private $db;
    public $errorCode;
    public $id;
    public $nome;
    public $cpf;


    function __construct(Conexao $db)
    {
        $this->db = $db;
        $this->errorCode = 0;
    }

    /**
     * @return bool
     */
    public function validaUser(string $usuario, string $senha)
    {

        if (!filter_var($usuario, FILTER_VALIDATE_EMAIL)) {
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

        //Buscar usuário
        $userValid = $this->db->executar("SELECT id, nome FROM alunos WHERE cpf = :cpf", true, false);
        $userValid->bindParam(":cpf", $ra_id);
        $userValid->execute();
        $userValid = $userValid->rowCount();
        if (!$userValid) {
            return false;
        }

        //Valida senha
        $result = $this->db->executar("SELECT senha FROM usuarios WHERE ra = :ra;", true, false);
        $result->bindParam(":ra", $ra_id);
        $result->execute();
        $result = $result->fetchAll();
        //if(!password_verify($password, $result[0]['senha']) && $result[0][0] != $password){ // IMPORTANTE -> A segunda parte do '&&' (E) deve ser removida após a padronização da criptografia!
        if (!password_verify($senha, $result[0]['senha'])) {
            return false;
        }
    }
}
