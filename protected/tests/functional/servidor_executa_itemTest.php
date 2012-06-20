<?php

class servidor_executa_itemTest extends WebTestCase
{
	public $fixtures=array(
		'servidor_executa_items'=>'servidor_executa_item',
	);

	public function testShow()
	{
		$this->open('?r=servidor_executa_item/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=servidor_executa_item/create');
	}

	public function testUpdate()
	{
		$this->open('?r=servidor_executa_item/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=servidor_executa_item/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=servidor_executa_item/index');
	}

	public function testAdmin()
	{
		$this->open('?r=servidor_executa_item/admin');
	}
}
