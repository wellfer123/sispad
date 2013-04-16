<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HighChartsUtil
 *
 * @author juniorpires
 */
class HighChartsUtil {
    
    
    /*metodo para gerar o array de dados 'series' da extensao highCharts
      @param $dataProvider os dados a serem utilizados no grafico 
      @param $name nome da serie 
      @param $label_fields nome dos campos dos dados do grafico
      @return retorna um array no formato series da extensao highCharts
     * 
     */  
    public static function getSeriesCharts($dataProvider,$name,$label_fields=array()){
        $series=array();
        
        foreach ($dataProvider->getData() as $value) {
            $data=array();
            foreach ($label_fields as $label) {
               array_push($data,(double)$value[$label]);
            }
             array_push($series,array("name"=>$value[$name],'data'=>$data));
            
        }
        
        return $series;

        
    }
}

?>
