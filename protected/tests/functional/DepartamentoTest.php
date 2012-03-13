<?php

class DepartamentoTest extends WebTestCase
{
	public $fixtures=array(
		'departamentos'=>'Departamento',
	);

	public function testShow()
	{
		$this->open('?r=departamento/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=departamento/create');
	}

	public function testUpdate()
	{
		$this->open('?r=departamento/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=departamento/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=departamento/index');
	}

	public function testAdmin()
	{
		$this->open('?r=departamento/admin');
	}
}
