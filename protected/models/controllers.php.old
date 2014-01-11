<?php

/**
 * This is the model class for table "controllers".
 *
 * The followings are the available columns in table 'controllers':
 * @property integer $id
 * @property integer $site_id
 * @property string $name
 * @property string $path
 * @property string $last_updated_at
 */
class controllers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return controllers the static model class
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
		return 'controllers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('site_id, name, path', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, site_id, name, path, last_updated_at', 'safe', 'on'=>'search'),
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
			'site_id' => 'Site',
			'name' => 'Name',
			'path' => 'Path',
			'last_updated_at' => 'Last Updated At',
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

		$criteria->compare('site_id',$this->site_id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('path',$this->path,true);

		$criteria->compare('last_updated_at',$this->last_updated_at,true);

		return new CActiveDataProvider('controllers', array(
			'criteria'=>$criteria,
		));
	}
	public static function allFunctions($controller)
	{
		$models = Functions::model()->findAllByAttributes(array('classid'=>$controller));
		$str='';
		foreach ($models as $model)
		{
			$str.= '<option value="'.$model->id.'">'.$model->name."</option>";
		}
		print $str;
	}
        
        
}

