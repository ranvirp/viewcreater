<?php

class viewTest extends WebTestCase
{
	public $fixtures=array(
		'views'=>'view',
	);

	public function testShow()
	{
		$this->open('?r=view/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=view/create');
	}

	public function testUpdate()
	{
		$this->open('?r=view/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=view/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=view/index');
	}

	public function testAdmin()
	{
		$this->open('?r=view/admin');
	}
}
