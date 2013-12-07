<?php

class sitesTest extends WebTestCase
{
	public $fixtures=array(
		'sites'=>'sites',
	);

	public function testShow()
	{
		$this->open('?r=sites/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=sites/create');
	}

	public function testUpdate()
	{
		$this->open('?r=sites/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=sites/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=sites/index');
	}

	public function testAdmin()
	{
		$this->open('?r=sites/admin');
	}
}
