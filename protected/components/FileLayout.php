<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileLayout
 *
 * @author Albuquerque
 */
class FileLayout {
    //put your code here
    private $fileName;
    
    private $columns;
    /**
     *
     * @param string $fileName caminho do arquivo layout
     */
    function __construct($fileName) {
        $this->fileName = dirname(__FILE__).'/../../files/'.$fileName;
        $this->columns=array();
        
        $this->popularColumns();
    }
    
    /**
     *
     * @return array de ColunaLayout ou null se não estiver populado 
     */
    public function getColumns(){
        return $this->columns;
    }
    /**
     *
     * @param string $columnName o nome da coluna
     * @return string se a coluna existir, caso não, retorna null 
     */
    public function getcolumn($columnName){
        if ( $this->columns != null ){
            return $this->columns[$columnName];
        }
        return null;
    }

    private function popularColumns(){
            $filename=$this->fileName;
            if (file_exists($filename) ){

                $arquivo_layout=file($filename);
                //verifica se a leitura foi realizada com suceso
                if( isset( $arquivo_layout) ){
                    //pega a quantidade de linhas
                    $size =count($arquivo_layout);
                    for($i=1; $i < $size; $i++) {
                        //pega o restante das linhas
                        $itensLines=explode(',',$arquivo_layout[$i]);
                        //cada linha representa dados sobre uma coluna
                        $sizeItens=count($itensLines);
                        //popula o objeto colunaLayout
                        $column=new ColunaLayout($itensLines[0], $itensLines[4], $itensLines[1], $itensLines[2], $itensLines[3]);
                        //o nome da coluna representa a chave no vetor
                        $this->columns[$itensLines[0]]=$column;
                    }
                    //terminou
                    return;
                }
            }
            else{
                Yii::log('Arquivo não encontrado');
            }
            $this->columns=null;
    }
}

?>
