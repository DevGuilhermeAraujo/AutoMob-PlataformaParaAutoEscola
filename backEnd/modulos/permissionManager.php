<?php 

    class permissonManager{

        private Sessao $sessao;

        private $pagLogin;
        private $pagIntrutor;
        private $pagAluno;

        function __construct(Sessao $sessao)
        {
            $this->sessao = $sessao;
            $this->pagLogin = "../Login/pagLogin.php";
            $this->pagIntrutor = "../Instrutor/homeInstrutor.php";
            $this->pagAluno = "../Usuario/homeUsuario.php";
        }

        public function redirect(){
            $sessao = $this->sessao;
            if($sessao->getTipoInt() == $sessao->getDbUtils()->PERMISSION_ALUNO()){
                header("Location: ".$this->pagAluno);
                return;
            }
            if($sessao->getTipoInt() == $sessao->getDbUtils()->PERMISSION_INSTRUTOR()){
                header("Location: ".$this->pagIntrutor);
                return;
            }
            $this->sessao->destroy();
            header("Location: ".$this->pagLogin);
            exit();
            return;
        }

        public function requeridLogin(?Int $permission = null, ?String $URL = null){
            if (!$this->sessao->logued($permission)) {
                if (is_null($URL)) {
                    $this->redirect();
                    return;
                } else {
                    header("Location: " . $URL);
                    return;
                }
            }
        }

    }

?>