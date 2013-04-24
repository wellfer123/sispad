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
      @param $series_visible booleana que define se as series iniciarão visivel ou nao. True por padrão 
      @return retorna um array no formato series da extensao highCharts
     * 
     */  
    public static function getSeriesCharts($dataProvider,$name,$label_fields=array(),$series_visible=true){
        $series=array();
        
        foreach ($dataProvider->getData() as $value) {
            $data=array();
            foreach ($label_fields as $label) {
               array_push($data,(double)$value[$label]);
            }
             array_push($series,array("name"=>$value[$name],'data'=>$data,'visible'=>$series_visible));
            
        }
        
        return $series;

        
    }
    
    
    
    
    
    /*metodo para gerar o array de dados 'series' da extensao highCharts
      @param $dataProvider os dados a serem utilizados no grafico 
      @param $name nome da serie 
      @param $label_fields nome dos campos dos dados do grafico
      @return retorna um array no formato series da extensao highCharts
     * 
     */  
    private static function getDrillDownCharts($dataProvider,$category_label,$groups=array()){
        $categories = array();
        $data_drill = array();
        $data = array($data_drill);  
        
        
        foreach ($dataProvider->getData() as $value) {
            foreach ($groups as $key=>$group) {
               array_push($group,(double)$value[$key]);
            }
            array_push($categories,$value[$category_label]);
            
        }
        
        foreach ($groups as $group) {
             $group[0] = 100;
             array_push($data_drill,array("drilldown"=>array("name"=>"Teste","categories"=>$categories,'data'=>$group)));
        }
        
        
       
        return $data;

        
    }
    
    private static function exibeArray($array){
        foreach ($array as $key => $value) {
             echo $key."->";
            if ( is_array($value)){
                HighChartsUtil::exibeArray($value);
            }else{
               echo $value;
               echo '';
                
            }
                
        }
    
    }
}



?>
