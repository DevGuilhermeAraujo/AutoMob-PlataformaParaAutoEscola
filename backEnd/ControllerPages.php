<?php 

    namespace backEnd\ControllerPages;

    use backEnd\sessao;

    class Pages{
        
        /**
         * @param string $url
         * @param array $vars
         * @return string
         */
        public function navigateTo($url){
            
            return "indexTest.php?page=$url&teste=".(__DIR__."../");
        }

    }

?>