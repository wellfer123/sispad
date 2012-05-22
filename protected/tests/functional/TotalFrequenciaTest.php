<?php

class TotalFrequenciaTest extends WebTestCase
{
	public $fixtures=array(
		'totalFrequencias'=>'TotalFrequencia',
	);

	public function testShow()
	{
		$this->open('?r=totalFrequencia/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=totalFrequencia/create');
	}

	public function testUpdate()
	{
		$this->open('?r=totalFrequencia/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=totalFrequencia/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=totalFrequencia/index');
	}

	public function testAdmin()
	{
		$this->open('?r=totalFrequencia/admin');
	}
}
