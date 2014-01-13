<?php

class htmlreferenceTest extends WebTestCase
{
	public $fixtures=array(
		'htmlreferences'=>'htmlreference',
	);

	public function testShow()
	{
		$this->open('?r=htmlreference/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=htmlreference/create');
	}

	public function testUpdate()
	{
		$this->open('?r=htmlreference/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=htmlreference/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=htmlreference/index');
	}

	public function testAdmin()
	{
		$this->open('?r=htmlreference/admin');
	}
}
