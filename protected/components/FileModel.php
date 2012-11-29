<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileModel
 *
 * @author Albuquerque
 */
class FileModel {
    //put your code here
    private $nameFileModel;
    private $nameFileLayout;
    private $nameClassModel;
    
    
    function __construct($nameFileModel, $nameFileLayout, $nameClassModel) {
        $this->nameFileModel = $nameFileModel;
        $this->nameFileLayout = $nameFileLayout;
        $this->nameClassModel = $nameClassModel;
    }
    
    /**
     *
     * @param array $mapColunmAttribute um array onde cada chave corresponde 
     * ao nome da coluna no arquivo e o valor ao atributo no modelo
     * @return array com modelos
     */
    public function popularModels($mapColunmAttribute){
        //verifica se é um array
        if (is_array($mapColunmAttribute) ){
            //verifica se o arquivo layout existe
            if ( !file_exists($this->nameFileLayout) ){
                //verifica se o arquivo FileModel
                if(!file_exists($this->nameFileModel) ){
                    //verifica se a classModel é uma CModel
                    if ( $this->nameClassModel instanceof CModel){
                        //começa a popular e salvar o model
                        $layout=new FileLayout($this->nameFileLayout);
                        $arquivo=fopen(dirname(__FILE__).'/../../files/'.$this->nameFileModel, 'r');
                        while (!feof($arquivo)){
                            $row = fgets($arquivo);
                            echo $row.'<br>';
                        }
                        fclose($arquivo);
                    }
                }
            }
        }
    }

}

?>
