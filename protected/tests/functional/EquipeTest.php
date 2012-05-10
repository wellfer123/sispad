<?php

class EquipeTest extends WebTestCase
{
	public $fixtures=array(
		'equipes'=>'Equipe',
	);

	public function testShow()
	{
		$this->open('?r=equipe/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=equipe/create');
	}

	public function testUpdate()
	{
		$this->open('?r=equipe/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=equipe/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=equipe/index');
	}

	public function testAdmin()
	{
		$this->open('?r=equipe/admin');
	}
}
