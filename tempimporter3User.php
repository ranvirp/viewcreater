<?php

/**
 * 
 * feel free to mod this Class
 *
 */
class tempimporter3User extends CActiveRecord1
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		// DO NOT CHANGE
		return YiiBase1::app()->controller->module->tableUser;

		// or use your known table name like
		// return 'TableUser';
	}

	public function rules()
	{
		return array();
	}

	public function relations()
	{
		return array();
	}

	public function attributeLabels()
	{
		return array();
	}
}