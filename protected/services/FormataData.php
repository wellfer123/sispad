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


   public static function inverteDataComHora($data,$delim){
       $dataHoraArray= explode(" ", $data);
       $dataarray = explode($delim,$dataHoraArray[0]);
       $data = $dataarray[2] . '/' . $dataarray[1] . '/' . $dataarray[0];
       $data=$data." ".$dataHoraArray[1];
       return ($data);
   }

   public static function calculaDiferencaDatas($data1,$data2,$formato,$delim){

            if($formato=="br"){
                $data1=self::inverteData($data1, $delim);
                $data2=self::inverteData($data2, $delim);

            }
                $data1Obj= new DateTime($data1);
                $data2Obj= new DateTime($data2);

                $result= ($data1Obj->getTimestamp()-$data2Obj->getTimestamp())/(60*60*24);
                return $result;

        }

         public static function geraArrayAnos($ano_inic,$ano_fim) {
                ++$ano_fim;
                $anos = array();
                for(;$ano_inic<$ano_fim;$ano_inic++){
                    $anos["$ano_inic"] = $ano_inic;
                }

                return $anos;
         }
           public static function geraArrayDiasDoMes($mes,$ano) {
                $dias_fim = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
                ++$dias_fim;
                for($dias_inic=1;$dias_inic<$dias_fim;$dias_inic++){
                    $dias["$dias_inic"] = "$dias_inic";
                }

                return $dias;
          }
}

?>
