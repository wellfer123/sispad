<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReaderFileToFillingModel
 *
 * @author Albuquerque
 */
class ReaderFileToFillingModel {
    //put your code here
    private $nameFile;
    private $nameModel;
    
    function __construct() {
    }
    
    function validate(){
        
    }
    
    function fillingDataBase(){
        
        $filename="tb_cid_layout.txt";
        
        $FileLayout= new FileLayout($filename);
        foreach ($FileLayout->getColumns() as $key=>$coluna){
            echo $key.'<br>';
        }
//        if (file_exists($filename) ){
//            
//            $arquivo_layout=file($filename);
//            //verifica se a leitura foi realizada com suceso
//            if( isset( $arquivo_layout) ){
//                $size =count($arquivo_layout);
//                echo $size.'<br>';
//                //primeira linha do arquivo é o cabeçalho
//                $header=explode(',', $arquivo_layout[0]);
//                for($i=1; $i < $size; $i++) {
//                    $itensLines=explode(',',$arquivo_layout[$i]);
//                    
//                    $sizeItens=count($itensLines);
//                    echo $sizeItens.'<br>';
//                    for($j=0; $j < $sizeItens; $j++){
//                      Yii::log( $header[$j].' => '.$itensLines[$j]);
//                    }
//                }
//            }
            
//        }
//        else{
//            Yii::log("deu merda");
//        }
    }
}

?>
