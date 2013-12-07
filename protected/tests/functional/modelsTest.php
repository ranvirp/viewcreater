<?php

class modelsTest extends WebTestCase
{
	public $fixtures=array(
		'models'=>'models',
	);

	public function testShow()
	{
		$this->open('?r=models/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=models/create');
	}

	public function testUpdate()
	{
		$this->open('?r=models/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=models/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=models/index');
	}

	public function testAdmin()
	{
		$this->open('?r=models/admin');
	}
}
