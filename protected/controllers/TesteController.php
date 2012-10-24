<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TesteController
 *
 * @author Albuquerque
 */
//Yii::import('application.lib.*');
//Yii::import('application.report.*');

//include_once('class/fpdf/fpdf.php');
//include_once("class/PHPJasperXML.inc.php");

        
Yii::import('application.report.*');
require_once 'cabaco.php';

class TesteController extends CController{
    //put your code here
    
    public function actionT(){
        
//        $xml =simplexml_load_file(Yii::app()->basePath.'/report/tes.jrxml');  
//        
//
//        $PHPJasperXML = new PHPJasperXML();
//
//        $PHPJasperXML->debugsql=false;
//        $PHPJasperXML->xml_dismantle($xml);
//
//        $PHPJasperXML->connect('localhost','root','','sispad');
//
//        $PHPJasperXML->transferDBtoArray('localhost','root','','sispad');
//
//        $PHPJasperXML->outpage('I');
       // error_reporting(0);
//$AReport = new IReport(Yii::app()->basePath.'/report/tes.jrxml');
//
////$AReport->parameters = array("parameter1"=>1);
//
//$AReport->execute();
//        
        
        $caba= new BaseReportList(null, 'P', 'mm', 'A4');
        $caba->CreateInvoice();
        $caba->Output();
   }

    protected function getModelName() {
        
    }
}

?>
