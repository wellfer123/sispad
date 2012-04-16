<?php

class IdentidadeTest extends WebTestCase
{
	public $fixtures=array(
		'identidades'=>'Identidade',
	);

	public function testShow()
	{
		$this->open('?r=identidade/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=identidade/create');
	}

	public function testUpdate()
	{
		$this->open('?r=identidade/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=identidade/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=identidade/index');
	}

	public function testAdmin()
	{
		$this->open('?r=identidade/admin');
	}
}
