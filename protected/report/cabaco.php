<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cabaco
 *
 * @author Albuquerque
 */
Yii::import('application.lib.tcpdf.*');

Yii::app()->getModule('bpa');
require_once 'tcpdf.php';

class BaseReportList extends TCPDF {
    
    private $invoiceData;
    //put your code here
    function __construct( $data, $orientation, $unit, $format ) {
    parent::__construct( $orientation, $unit, $format, true, 'UTF-8', false );

    //$this->ou
    # cada lado com 1,5 cm de margem e topo com 5 cm/ 50mm
    $this->SetMargins( 15, 50, 15, true );
    $this->SetAutoPageBreak( true, 36 );
    $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

    global $l;
    $this->setLanguageArray($l);
}

    public function Header() {
        
        $this->Image(K_PATH_IMAGES.'logo.png', 50, 0.95, 0, 0, 'PNG', false, 'M', false, 1.2);
        //cria uma celula da larguda da folha
        $this->Cell(0);
        //cria várias linhas iguais a célula anterior
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
       $this->SetFont('helvetica', 'B', 14);
//        // Title
        $this->Cell(0, 0, 'Relatório Gerencial', 0, false, 'C', 0, '', 0, false, 'M', 'M');

    }


    public function Footer() {
        global $webcolor;

        $this->SetLineStyle( array( 'width' => 1.2, 'color' => 
        array( $webcolor['black'] ) ) );
        $this->Line( 13, $this->getPageHeight() - 1.5 * 13 - 2, 
        $this->getPageWidth() - 13, $this->getPageHeight() - 1.5 * 13 - 2 );
        
        $this->SetFont( 'times', '', 10 );
        $this->SetY( -1.5 * 13, true );
        $this->Cell( 0, 0, 'Rua Martin Afonso, 267 - São Francisco - Telefone: 81 3701 1400 - CEP: 55006-280 Caruaru - PE',0,0,'C');
        
        $this->SetY( -1.2 * 13, true );
        $this->Cell(0, 0,  'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(),0,0,'C');
        
        //$this->
    }
    
    public function CreateInvoice() {
        $this->AddPage();
        $this->SetFont( 'helvetica', '', 9 );
        //necessário para pular o cabeçalho
        $this->SetY(50, true);

        # Table parameters
        #
        # Column size, wide (description) column, table indent, row height.
        $col = 30; //30 mm
        $wideCol = 3 * $col;
        $indent = 0.1;// 1mm ( $this->getPageWidth() - 2 * 72 - $wideCol - 3 * $col ) / 2;
        $line = 2.5; // 3 mm

        # Table header
        $this->SetFont( '', 'b',12 );
        $this->Cell( $indent );
        $this->Cell( $col, $line, 'Item', 0, 0, 'L' );
        $this->Cell( $col, $line, 'Quantity', 0, 0, 'R' );
        $this->Cell( $col, $line, 'Price', 0, 0, 'R' );
        $this->Cell( $col, $line, 'Cost', 0, 0, 'R' );
        $this->Ln();

        $pogArray= Paciente::model()->findAll();
        # Table content rows
        $this->SetFont( '', '',9 );
        foreach( $pogArray as $cli ) {
            $this->Cell( $indent );
            $this->Cell( $col, $line, $cli->nome, 0, 0, 'L' );
            $this->Cell( $col, $line, $cli->sexo, 0, 0, 'R' );
            $this->Cell( $col, $line, $cli->cns, 0, 0, 'R' );
            $this->Cell( $col, $line, $cli->cidade, 0, 0, 'R' );
            $this->Ln();
        }

        # Table Total row
        $this->SetFont( '', 'b' );
        $this->Cell( $indent );
        $this->Cell( $wideCol + $col * 2, $line, 'Total:', 1, 0, 'R' );
        $this->SetFont( '', '' );
        $this->Cell( $col, $line, 'total', 1, 0, 'R' );
    }
}

?>
