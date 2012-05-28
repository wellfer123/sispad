<?php

class usuario_desktopTest extends WebTestCase
{
	public $fixtures=array(
		'usuario_desktops'=>'usuario_desktop',
	);

	public function testShow()
	{
		$this->open('?r=usuario_desktop/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=usuario_desktop/create');
	}

	public function testUpdate()
	{
		$this->open('?r=usuario_desktop/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=usuario_desktop/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=usuario_desktop/index');
	}

	public function testAdmin()
	{
		$this->open('?r=usuario_desktop/admin');
	}
}
