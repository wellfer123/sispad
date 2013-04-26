<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SistemaController
 *
 * @author Albuquerque
 */
class SistemaController extends SISPADBaseController {

    //put your code here

    public function actionBPAI() {
        //arquivo com os recursos que devem ser atualizados no BPAI
        $path = dirname(__FILE__) . '/../files/teste.xml';
        $ext = 'xml';
        if ( file_exists($path)) {
            $this->facaDownload($path, $ext);
        }
        header("HTTP/1.1 404 Not Found");
        return;
    }
    
    public function actionBPAIBanco() {
        //arquivo com os recursos que devem ser atualizados no BPAI
        $path = dirname(__FILE__) . '/../files/banco.gdb';
        $ext = 'GDB';
        if ( file_exists($path)) {
            $this->facaDownload($path, $ext);
        }
        header("HTTP/1.1 404 Not Found");
        return;
    }
    
    public function actionBPAIUpdateResource(){
        //verifica se os parâmetros foram passados
        if (isset($_GET['f']) && isset($_GET['e'])) {
            $path = dirname(__FILE__) . '/../files/' . $_GET['f'] . '.' . $_GET['e'];
            $ext = $_GET['e'];
            if (file_exists($path) ){
                $this->facaDownload($path, $ext);
                return ;
            }
        }
        //se não deu certo retorna um erro.
        header("HTTP/1.1 404 Not Found");
        return;
    }
    protected function getModelName() {
        return "Sistema";
    }

    private function  facaDownload($nameFile,$ext){
        header("Content-Type: application/" . $ext); // informa o tipo do arquivo ao navegador
        header("Content-Length: " . filesize($nameFile)); // informa o tamanho do arquivo ao navegador
        header("Content-Disposition: attachment; filename=" . basename($nameFile));
        readfile($nameFile);
        exit();
    }
}

?>
