<?php

class functionsTest extends WebTestCase
{
	public $fixtures=array(
		'functions'=>'functions',
	);

	public function testShow()
	{
		$this->open('?r=functions/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=functions/create');
	}

	public function testUpdate()
	{
		$this->open('?r=functions/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=functions/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=functions/index');
	}

	public function testAdmin()
	{
		$this->open('?r=functions/admin');
	}
}
