<?php

class AgenteSaudeExecutaMetaTest extends WebTestCase
{
	public $fixtures=array(
		'agente_saude_executa_metas'=>'agente_saude_executa_meta',
	);

	public function testShow()
	{
		$this->open('?r=agente_saude_executa_meta/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=agente_saude_executa_meta/create');
	}

	public function testUpdate()
	{
		$this->open('?r=agente_saude_executa_meta/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=agente_saude_executa_meta/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=agente_saude_executa_meta/index');
	}

	public function testAdmin()
	{
		$this->open('?r=agente_saude_executa_meta/admin');
	}
}
