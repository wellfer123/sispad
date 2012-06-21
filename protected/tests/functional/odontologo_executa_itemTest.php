<?php

class odontologo_executa_itemTest extends WebTestCase
{
	public $fixtures=array(
		'odontologo_executa_items'=>'odontologo_executa_item',
	);

	public function testShow()
	{
		$this->open('?r=odontologo_executa_item/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=odontologo_executa_item/create');
	}

	public function testUpdate()
	{
		$this->open('?r=odontologo_executa_item/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=odontologo_executa_item/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=odontologo_executa_item/index');
	}

	public function testAdmin()
	{
		$this->open('?r=odontologo_executa_item/admin');
	}
}
