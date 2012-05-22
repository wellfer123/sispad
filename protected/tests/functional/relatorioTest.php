<?php

class relatorioTest extends WebTestCase
{
	public $fixtures=array(
		'relatorios'=>'relatorio',
	);

	public function testShow()
	{
		$this->open('?r=relatorio/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=relatorio/create');
	}

	public function testUpdate()
	{
		$this->open('?r=relatorio/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=relatorio/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=relatorio/index');
	}

	public function testAdmin()
	{
		$this->open('?r=relatorio/admin');
	}
}
