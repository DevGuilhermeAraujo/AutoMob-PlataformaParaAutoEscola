<?php 

class validaUsuario{
    
    private $db;


    function __construct(Conexao $db)
    {
        $this->db = $db;
    }

    /**
     * @return bool
     */
    public function validaUser(string $usuario, string $senha){
        
    } 

}

?>