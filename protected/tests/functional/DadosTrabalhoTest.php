<?php

class DadosTrabalhoTest extends WebTestCase
{
	public $fixtures=array(
		'dadosTrabalhos'=>'DadosTrabalho',
	);

	public function testShow()
	{
		$this->open('?r=dadosTrabalho/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=dadosTrabalho/create');
	}

	public function testUpdate()
	{
		$this->open('?r=dadosTrabalho/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=dadosTrabalho/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=dadosTrabalho/index');
	}

	public function testAdmin()
	{
		$this->open('?r=dadosTrabalho/admin');
	}
}
