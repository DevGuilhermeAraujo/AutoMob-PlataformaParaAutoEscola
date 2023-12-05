<?php 
include_once dirname(__DIR__,1) ."/conexao.php";

class dbUtils{

    private Conexao $db;

    /**
     * @param Conexao $db
     */
    function __construct(Conexao $db){
        $this->db = $db;
    }

    //Constantes
    public function PERMISSION_INSTRUTOR(){
        return $this->getCodeTipo("Instrutor");
    }
    public function PERMISSION_ALUNO(){
        return $this->getCodeTipo("Aluno");
    }
    //

    public function getAllTipos(){
        return $this->db->executar("SELECT id FROM tipos");
    }
    
    public function getCodeTipo(string $tipoStr){
        $result = $this->db->executar("SELECT id FROM tipos WHERE UPPER(tipoNome) = UPPER(:str)",true,false);
        $result->bindParam(":str",$tipoStr);
        $result->execute();
        $result = $result->fetchAll();
        return isset($result[0][0])?$result[0][0]:"";
    }

    public function getStrTipo(int $tipoCode){
        $result = $this->db->executar("SELECT tipoNome FROM tipos WHERE id = :code",true,false);
        $result->bindParam(":code",$tipoCode);
        $result->execute();
        $result = $result->fetchAll();
        return isset($result[0][0])?$result[0][0]:-1;
    }
}

?>