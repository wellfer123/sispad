<?php

class ProcedimentoTest extends WebTestCase
{
	public $fixtures=array(
		'procedimentos'=>'Procedimento',
	);

	public function testShow()
	{
		$this->open('?r=procedimento/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=procedimento/create');
	}

	public function testUpdate()
	{
		$this->open('?r=procedimento/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=procedimento/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=procedimento/index');
	}

	public function testAdmin()
	{
		$this->open('?r=procedimento/admin');
	}
}
