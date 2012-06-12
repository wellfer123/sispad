<?php

class MedicoExecutaMetaTest extends WebTestCase
{
	public $fixtures=array(
		'medico_executa_metas'=>'medico_executa_meta',
	);

	public function testShow()
	{
		$this->open('?r=medico_executa_meta/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=medico_executa_meta/create');
	}

	public function testUpdate()
	{
		$this->open('?r=medico_executa_meta/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=medico_executa_meta/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=medico_executa_meta/index');
	}

	public function testAdmin()
	{
		$this->open('?r=medico_executa_meta/admin');
	}
}
