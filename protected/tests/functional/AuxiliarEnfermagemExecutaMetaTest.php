<?php

class AuxiliarEnfermagemExecutaMetaTest extends WebTestCase
{
	public $fixtures=array(
		'auxiliar_enfermagem_executa_metas'=>'auxiliar_enfermagem_executa_meta',
	);

	public function testShow()
	{
		$this->open('?r=auxiliar_enfermagem_executa_meta/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=auxiliar_enfermagem_executa_meta/create');
	}

	public function testUpdate()
	{
		$this->open('?r=auxiliar_enfermagem_executa_meta/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=auxiliar_enfermagem_executa_meta/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=auxiliar_enfermagem_executa_meta/index');
	}

	public function testAdmin()
	{
		$this->open('?r=auxiliar_enfermagem_executa_meta/admin');
	}
}
