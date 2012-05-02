<?php

class faltaTest extends WebTestCase
{
	public $fixtures=array(
		'faltas'=>'falta',
	);

	public function testShow()
	{
		$this->open('?r=falta/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=falta/create');
	}

	public function testUpdate()
	{
		$this->open('?r=falta/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=falta/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=falta/index');
	}

	public function testAdmin()
	{
		$this->open('?r=falta/admin');
	}
}
