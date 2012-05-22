<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParserDate
 *
 * @author Albuquerque
 */
class ParserDate extends CComponent{
    //put your code here
    
    public static function inverteDataPtToEn($data){
            //dd/mm/yy
            $dataarray = explode('/',$data);
            return $data = $dataarray[2] . '-' . $dataarray[1] . '-' . $dataarray[0];

        }
    public static function inverteDataEnToPt($data){
            //dd/mm/yy
            $dataarray = explode('-',$data);
            return $data = $dataarray[2] . '/' . $dataarray[1] . '/' . $dataarray[0];

        }
}

?>
