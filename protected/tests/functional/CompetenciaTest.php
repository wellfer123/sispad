<?php

class CompetenciaTest extends WebTestCase
{
	public $fixtures=array(
		'competencias'=>'Competencia',
	);

	public function testShow()
	{
		$this->open('?r=competencia/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=competencia/create');
	}

	public function testUpdate()
	{
		$this->open('?r=competencia/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=competencia/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=competencia/index');
	}

	public function testAdmin()
	{
		$this->open('?r=competencia/admin');
	}
}
