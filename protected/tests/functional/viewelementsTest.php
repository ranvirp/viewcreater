<?php

class viewelementsTest extends WebTestCase
{
	public $fixtures=array(
		'viewelements'=>'viewelements',
	);

	public function testShow()
	{
		$this->open('?r=viewelements/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=viewelements/create');
	}

	public function testUpdate()
	{
		$this->open('?r=viewelements/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=viewelements/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=viewelements/index');
	}

	public function testAdmin()
	{
		$this->open('?r=viewelements/admin');
	}
}
