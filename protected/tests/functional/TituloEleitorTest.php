<?php

class TituloEleitorTest extends WebTestCase
{
	public $fixtures=array(
		'tituloEleitors'=>'TituloEleitor',
	);

	public function testShow()
	{
		$this->open('?r=tituloEleitor/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=tituloEleitor/create');
	}

	public function testUpdate()
	{
		$this->open('?r=tituloEleitor/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=tituloEleitor/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=tituloEleitor/index');
	}

	public function testAdmin()
	{
		$this->open('?r=tituloEleitor/admin');
	}
}
