<?php

class UnidadeTest extends WebTestCase
{
	public $fixtures=array(
		'unidades'=>'Unidade',
	);

	public function testShow()
	{
		$this->open('?r=unidade/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=unidade/create');
	}

	public function testUpdate()
	{
		$this->open('?r=unidade/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=unidade/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=unidade/index');
	}

	public function testAdmin()
	{
		$this->open('?r=unidade/admin');
	}
}
