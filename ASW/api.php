<?php


class API {
    
    
    public function run(){
        
        $metodo = key_exists('metodo', $_POST);
        
        if(!$metodo){
            throw new Exception('A method is required');
        }
        
        switch($metodo){
            case 'getJogadaActual' : 
                $this->getJogadaActual();
                break;
            default: 
                throw new Exception('Invalid method');
        }
        
    }
    
    /**
     * 
     */
    public function getJogadaActual(){
        $jogo = $_POST['jogo'];
        
        global $conn;

        echo json_encode(array('jogada' => verificaNumeroJogadasFeitas($jogo, $conn)));
        
        
    }
}



$api = new API;
$api->run();