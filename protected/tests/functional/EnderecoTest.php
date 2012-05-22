<?php

class EnderecoTest extends WebTestCase
{
	public $fixtures=array(
		'enderecos'=>'Endereco',
	);

	public function testShow()
	{
		$this->open('?r=endereco/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=endereco/create');
	}

	public function testUpdate()
	{
		$this->open('?r=endereco/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=endereco/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=endereco/index');
	}

	public function testAdmin()
	{
		$this->open('?r=endereco/admin');
	}
}
