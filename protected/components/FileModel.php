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
        set_time_limit(-1);
        //verifica se é um array
        if (is_array($mapColunmAttribute) ){
            //verifica se o arquivo layout existe
            if ( !file_exists($this->nameFileLayout) ){
                //verifica se o arquivo FileModel
                if(!file_exists($this->nameFileModel) ){
                    //começa a popular e salvar o model
                    $layout=new FileLayout($this->nameFileLayout);
                    $arquivo=fopen(dirname(__FILE__).'/../../files/'.$this->nameFileModel, 'r');
                    $vetor=array();
                    $contador=0;
                    $dao= new ModelDao($this->nameClassModel);
                    while (!feof($arquivo)){
                        //ler um registro
                        $row = fgets($arquivo);
                        //pega as colunas
                        $colunas=$layout->getColumns();
                        if ( $colunas!= null && !empty ($row)){
                            //instancia um objeto
                            $model= new $this->nameClassModel();
                            foreach ($colunas as $coluna){
                                //pega uma substring, codifica para utf-8 e retira os espaços iniciais e finais
                                $str=utf8_encode(trim(substr($row, $coluna->getInicio()-1, $coluna->getTamanho())));
                                $atributo=$mapColunmAttribute[$coluna->getNome()];
                                $model->{$atributo}= mb_strtoupper( $str,'UTF-8');
                            }//fim do foreach para popular um model
                            $vetor[]=$model;
                            ++$contador;
                        }//fim do if para verificar se existe colunas
                        //a cada 500 registros faz uma inserção
                        if ( $contador === 499){
                            $dao->insertMultiple($vetor);
                            $contador=0;
                            $vetor=array();
                        }//fim do if para pagninaçao dos inserts
                    }//fim do while
                    //verifica se tem registros a serem inseridos no banco
                    if ( $contador != 0 ){
                        $dao->insertMultiple($vetor);
                    }
                    fclose($arquivo);
                }
            }
        }
    }

}

?>
