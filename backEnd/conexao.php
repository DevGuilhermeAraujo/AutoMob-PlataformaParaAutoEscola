<?php 
    class Conexao{
    private $host = "localhost";
    private $port = "3306";
    private $user = "root";
    private $pass = "";
    private $dbname = "autoescola";
    private $pdo = null; 


    public function __construct()
    {
        try{
            $this->pdo = new PDO("mysql: dbname=" . $this->dbname . ";host=" . $this->host . ";port=
            " . $this->port , $this->user, $this->pass);   

          }  catch(Exception $e){
                echo "Banco de dados não conectado.";
                echo $e->getCode();
          }
    }

    public function executar($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt-> fetchAll();
        return $result;

    }
    
}
?>