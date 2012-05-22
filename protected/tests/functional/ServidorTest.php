<?php

class ServidorTest extends WebTestCase
{
	public $fixtures=array(
		'servidors'=>'Servidor',
	);

	public function testShow()
	{
		$this->open('?r=servidor/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=servidor/create');
	}

	public function testUpdate()
	{
		$this->open('?r=servidor/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=servidor/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=servidor/index');
	}

	public function testAdmin()
	{
		$this->open('?r=servidor/admin');
	}
}
