<?php

/**
 * This is the model class for table "sites".
 *
 * The followings are the available columns in table 'sites':
 * @property string $name
 * @property string $path
 * @property string $ident
 */
class sites extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return sites the static model class
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
		return 'sites';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, path, ident', 'required'),
			array('name', 'length', 'max'=>255),
			array('ident', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, path, ident', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'path' => 'Path',
			'ident' => 'Ident',
		);
	}
	public static function importSite($siteId)
		
	{
		$site=Sites::model()->findByPk($siteId);
		SiteImporter::import($site);
	}
	
}