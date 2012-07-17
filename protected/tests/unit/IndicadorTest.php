<?php

class IndicadorTest extends CDbTestCase
{
	public $fixtures=array(
		'indicadores'=>':Indicador',
	);

	public function testCreate()
	{

	}
        
        public function testCrud(){
            $in=$this->indicadores['indMedico'];
            
            $this->assertTrue($in!==NULL);
            
            $ind= new Indicador();
            
            $ind->afericao='';
            $ind->profissao_codigo=311;
            $ind->nome='Indicador de Médico';
            $ind->descricao='Indicador de médico ai vai uma descrição';
            $ind->status=Indicador::ATIVO;
            
            $this->assertTrue($ind->save());
            
            $this->assertTrue($ind->delete());
        }
}