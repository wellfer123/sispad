<?php

class agente_saude_executa_itemTest extends WebTestCase
{
	public $fixtures=array(
		'agente_saude_executa_items'=>'agente_saude_executa_item',
	);

	public function testShow()
	{
		$this->open('?r=agente_saude_executa_item/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=agente_saude_executa_item/create');
	}

	public function testUpdate()
	{
		$this->open('?r=agente_saude_executa_item/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=agente_saude_executa_item/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=agente_saude_executa_item/index');
	}

	public function testAdmin()
	{
		$this->open('?r=agente_saude_executa_item/admin');
	}
}
