<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormataData
 *
 * @author Junior Pires
 */
 class FormataData {



    public static function inverteData($data,$delim){
            $dataarray = explode($delim,$data);
            return $data = $dataarray[2] . '/' . $dataarray[1] . '/' . $dataarray[0];

        }
}
?>
