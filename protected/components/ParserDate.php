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
    public static function separarDataEHora($timestamp){
        if( $timestamp != null){
            
            return explode(' ', $timestamp);
        }
        return null;
    }
    
    /**
     * Função  = Calcular a Diferenca entre Data e Hora com PHP
     * Criador = Emerson Thiago Sousa Albuquerque
     * Data    = 24/05/2011 
     *
     * @ Parametros
     *   hora_ini = Hora inícial
     *   data_ini = Data inícial
     *   hora_fim = Hora final
     *   data_fim = Data final
     *   tipo => A => ano, M => mês, D => dias, H => horas, MM => minutos;
     *
     * Objetivo = Calcular a quanto de tempo seja Anos, Mês, Dia, Hora ou Minutos
     * de terminado periodo
     * Onde Utilizar? = Em modulos de RH para saber quanto de tempo de trabalho
     *
     *     Cálcular A = ?    | Cálcular B = 5 dias |    Cálcular C = ?  |
     * ----------|---------- |---------|-----------|----------|---------|------------------
     * hora_ini          data_ini               data_fim            hora_fim      Total (D)
     * ---|------------------|---------------------|--------------------|------=-----------
     * 15:50:35          05/10/11               08/10/11            10:30:00     5 dias e ?
     * 
     * Nesta função temos que cálcular os 3 intervalos A, B e C e soma os resultados
     * Levando em consideração qual é o tipo de valor A, M, D.
     */  
 
    public static function calculeDiferencaData($hora_ini, $data_ini, $hora_fim, $data_fim, $tipo='H', $exp = '/'){
        /* Definir os tamanhos do array Tipo */
        $tipoArr = array("A" => 31104000, "M" => 2592000, "D" => 86400, "H" => 3600, "MM" => 60);

        /* Prepara informações */
        $hora_ini_int  = explode(':',  $hora_ini);
        $data_ini_int  = explode($exp, $data_ini);
        $hora_fim_int  = explode(':',  $hora_fim);
        $data_fim_int  = explode($exp, $data_fim);

        if($data_ini != $data_fim){
            /* Verificar quando o periodo for data diferetes */

            /* CALCULAR A */   
            /* Calcular Bloco A Dif entre hora_ini até a data_ini */
            $intervalo_A_i = mktime($hora_ini_int[0], $hora_ini_int[1], $hora_ini_int[2], $data_ini_int[1], $data_ini_int[0], $data_ini_int[2]);
            $intervalo_A_f = mktime(24, 0, 0, $data_ini_int[1], $data_ini_int[0], $data_ini_int[2]);
            /* Resultado final do Intervalo */
            $intervalo_A   = bcsub($intervalo_A_f, $intervalo_A_i, 0); 

            /* CALCULAR B */
            $intervalo_B_i = mktime(0, 0, 0,  $data_ini_int[1], $data_ini_int[0], $data_ini_int[2]);
            $intervalo_B_f = mktime(0, 0, 0,  $data_fim_int[1], $data_fim_int[0], $data_fim_int[2]);
            /* Resultado final do Intervalo */
            $intervalo_B   = bcsub($intervalo_B_f, $intervalo_B_i, 0);

            /* CALCULAR C */   
            $intervalo_C_i = mktime(0, 0, 0, $data_fim_int[1], $data_fim_int[0], $data_fim_int[2]);
            $intervalo_C_f = mktime($hora_fim_int[0], $hora_fim_int[1], $hora_fim_int[2], $data_fim_int[1], $data_fim_int[0], $data_fim_int[2]);
            /* Resultado final do Intervalo */
            $intervalo_C   = bcsub($intervalo_C_f, $intervalo_C_i, 0);

            /* Informar quando total final do periodo */
            return bcdiv(bcadd(bcadd($intervalo_A, $intervalo_B, 0), $intervalo_C, 0), $tipoArr[$tipo], 4);      

        }else{
            /* Verificar quando o periodo for data iguais */

            /* CALCULO SIMPLES */  
            /* Calcular Bloco A Dif entre hora_ini até a data_ini */
            $intervalo_A_i = mktime($hora_ini_int[0], $hora_ini_int[1], $hora_ini_int[2], $data_ini_int[1], $data_ini_int[0], $data_ini_int[2]);
            $intervalo_A_f = mktime($hora_fim_int[0], $hora_fim_int[1], $hora_fim_int[2], $data_fim_int[1], $data_fim_int[0], $data_fim_int[2]);
            /* Resultado final do Intervalo */
            $intervalo_A   = bcsub($intervalo_A_f, $intervalo_A_i, 0); 

            /* Informar quando total final do periodo */
            return bcdiv($intervalo_A, $tipoArr[$tipo], 4);      
        }
    }
    
}

?>
