<?php

/**
 * This is the model class for table "Classes".
 *
 * The followings are the available columns in table 'Classes':
 * @property integer $id
 * @property integer $siteid
 * @property string $name
 * @property string $type
 * @property string $path
 * @property string $code
 * @property integer $updated
 */
class Classes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Classes the static model class
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
		return 'Classes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('siteid, name, type, path, code', 'required'),
			array('siteid, updated', 'numerical', 'integerOnly'=>true),
			array('name, type', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, siteid, name, type, path, code, updated', 'safe', 'on'=>'search'),
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
			'siteid' => 'Siteid',
			'name' => 'Name',
			'type' => 'Type',
			'path' => 'Path',
			'code' => 'Code',
			'updated' => 'Updated',
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

		$criteria->compare('siteid',$this->siteid);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('type',$this->type,true);

		$criteria->compare('path',$this->path,true);

		$criteria->compare('code',$this->code,true);

		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider('Classes', array(
			'criteria'=>$criteria,
		));
	}
}