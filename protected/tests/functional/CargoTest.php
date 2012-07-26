<?php

class CargoTest extends WebTestCase
{
	public $fixtures=array(
		'cargos'=>'Cargo',
	);

	public function testShow()
	{
		$this->open('?r=cargo/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=cargo/create');
	}

	public function testUpdate()
	{
		$this->open('?r=cargo/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=cargo/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=cargo/index');
	}

	public function testAdmin()
	{
		$this->open('?r=cargo/admin');
	}
}
