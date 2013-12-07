<?php

/**
 * This is the model class for table "modelAttributes".
 *
 * The followings are the available columns in table 'modelAttributes':
 * @property integer $id
 * @property integer $modelid
 * @property integer $name
 * @property integer $type
 * @property integer $size
 * @property integer $constraints
 */
class modelAttributes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return modelAttributes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'modelAttributes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('modelid, name, type', 'required'),
			array('modelid, name, type, size, constraints', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, modelid, name, type, size, constraints', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'modelid' => 'Modelid',
			'name' => 'Name',
			'type' => 'Type',
			'size' => 'Size',
			'constraints' => 'Constraints',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('modelid',$this->modelid);

		$criteria->compare('name',$this->name);

		$criteria->compare('type',$this->type);

		$criteria->compare('size',$this->size);

		$criteria->compare('constraints',$this->constraints);

		return new CActiveDataProvider('modelAttributes', array(
			'criteria'=>$criteria,
		));
	}
}