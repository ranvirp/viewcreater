<?php

class controllersTest extends WebTestCase
{
	public $fixtures=array(
		'controllers'=>'controllers',
	);

	public function testShow()
	{
		$this->open('?r=controllers/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=controllers/create');
	}

	public function testUpdate()
	{
		$this->open('?r=controllers/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=controllers/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=controllers/index');
	}

	public function testAdmin()
	{
		$this->open('?r=controllers/admin');
	}
}
