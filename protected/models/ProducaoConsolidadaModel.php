<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProducaoConsolidadaModel
 *
 * @author César Albuquerque
 */
class ProducaoConsolidadaModel extends CFormModel{
    //put your code here
    
    public $grupo;
    public $total;
    
    public $unidade;
    public $data;
    
    public $id;
    public $primaryKey;
    
    public function rules() {
        return array(
                    array('data, unidade', 'safe', 'on'=>'search'),
        );
    }
    
    public function search(){
        //monta o where da consulta
        $where= null;
        //atributo unidade
        if ($this->unidade != null){
            $where= " WHERE pd.unidade_cnes='".$this->unidade."'"; 
        }
        //atributo grupo
        if ($this->data != null){
            
            if ($where != null){
                $where=$where." AND pd.data='".$this->data."'";
            }
            else{
               $where=" WHERE pd.data='".$this->data."'"; 
            }
        }
        
        
        $query = "SELECT gr.nome AS grupo, SUM(pd.quantidade) AS total FROM unidade uni ";
        $query = $query . ' INNER JOIN unidade_especialidade ue ON uni.cnes=ue.unidade_cnes ';
        $query = $query . ' INNER JOIN producao_diaria pd ON (ue.unidade_cnes=pd.unidade_cnes AND ue.profissao_codigo=pd.profissao_codigo) ';
        $query = $query . ' INNER JOIN grupo gr ON (gr.codigo=ue.grupo_codigo) ';
        //clausula where
        if ($where != NULL){
            $query=$query.$where;
        }
        
        $query = $query . ' GROUP BY pd.unidade_cnes';
        $query = $query . ' ORDER BY gr.nome ';

        $rows = Yii::app()->db->createCommand($query)->queryAll();
        $list=array();
        foreach ($rows as $row){
            $model= new ProducaoConsolidadaModel();
            $model->grupo=$row['grupo'];
            $model->total=$row['total'];
            
            $list[]=$model;
        }
        
        $dataProvider = new CArrayDataProvider($list, array(
            'id' => 'user',
            'pagination' => array(
                'pageSize' => 30,
            ),
        ));

        return $dataProvider;
    }
}

?>
