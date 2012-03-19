<?php

class TotalRelatorioTest extends WebTestCase
{
	public $fixtures=array(
		'totalRelatorios'=>'TotalRelatorio',
	);

	public function testShow()
	{
		$this->open('?r=totalRelatorio/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=totalRelatorio/create');
	}

	public function testUpdate()
	{
		$this->open('?r=totalRelatorio/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=totalRelatorio/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=totalRelatorio/index');
	}

	public function testAdmin()
	{
		$this->open('?r=totalRelatorio/admin');
	}
}
