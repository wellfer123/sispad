<?php

class OdontologoExecutaMetaTest extends WebTestCase
{
	public $fixtures=array(
		'odontologo_executa_metas'=>'odontologo_executa_meta',
	);

	public function testShow()
	{
		$this->open('?r=odontologo_executa_meta/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=odontologo_executa_meta/create');
	}

	public function testUpdate()
	{
		$this->open('?r=odontologo_executa_meta/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=odontologo_executa_meta/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=odontologo_executa_meta/index');
	}

	public function testAdmin()
	{
		$this->open('?r=odontologo_executa_meta/admin');
	}
}
