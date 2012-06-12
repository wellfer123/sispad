<?php

class tecnico_enfermagem_executa_metaTest extends WebTestCase
{
	public $fixtures=array(
		'tecnico_enfermagem_executa_metas'=>'tecnico_enfermagem_executa_meta',
	);

	public function testShow()
	{
		$this->open('?r=tecnico_enfermagem_executa_meta/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=tecnico_enfermagem_executa_meta/create');
	}

	public function testUpdate()
	{
		$this->open('?r=tecnico_enfermagem_executa_meta/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=tecnico_enfermagem_executa_meta/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=tecnico_enfermagem_executa_meta/index');
	}

	public function testAdmin()
	{
		$this->open('?r=tecnico_enfermagem_executa_meta/admin');
	}
}
