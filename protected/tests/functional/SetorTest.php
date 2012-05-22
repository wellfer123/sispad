<?php

class SetorTest extends WebTestCase
{
	public $fixtures=array(
		'setors'=>'Setor',
	);

	public function testShow()
	{
		$this->open('?r=setor/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=setor/create');
	}

	public function testUpdate()
	{
		$this->open('?r=setor/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=setor/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=setor/index');
	}

	public function testAdmin()
	{
		$this->open('?r=setor/admin');
	}
}
