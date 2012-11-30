<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CidDao
 *
 * @author Albuquerque
 */
class ModelDao {
    //put your code here
    public $classeModel;
    
    function __construct($classeModel) {
        $this->classeModel = $classeModel;
    }

    public function insertMultiple($listModels){
        if(is_array($listModels) ){
            $query=null;
            $classe=new $this->classeModel();
            if( $classe instanceof CModel){
                $query="INSERT INTO ".$classe->tableName().'(';
                
                $attributes=$classe->getAttributes();
                $cont=0;
                //monta os campos da tabela
                foreach($attributes as $atri=>$value){
                    if($cont !== 0){
                        $query="$query,$atri";
                    }else{
                        $query=$query.$atri;
                    }
                    $cont++;
                }
                $query="$query ) VALUES ";
                //monta o a clausula values
                $cont=0;
                foreach ($listModels as $key=>$model){
                    
                    
                    if ( $cont !== 0 ){
                        $query="$query, ";
                    }
                    $contador=0;
                    foreach($attributes as $atri=>$value){
                        //não é primeiro campo
                        if ( $contador !== 0){
                            $query="$query, '".$model->{$atri}."'";
                        }
                        //é o primeiro campo
                        else{
                            $query="$query ( '".$model->{$atri}."'";
                        }
                        $contador++;
                    }
                    
                    $query=$query.')';
                    $cont++;
                }
                $query=$query.';';
                $connection=Yii::app()->db;
                $transaction=$connection->beginTransaction();
                try{
                    $command=$connection->createCommand($query);
                    $command->execute();
                    $transaction->commit();
                }  catch (Exception $ex){
                    Yii::log($ex->getMessage(), Clogger::LEVEL_ERROR);
                    $transaction->rollback();
                }
            }
        Yii::log($query);
        }
    }
}

?>
