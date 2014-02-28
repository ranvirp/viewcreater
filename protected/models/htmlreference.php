<?php

/**
 * This is the model class for table "htmlreference".
 *
 * The followings are the available columns in table 'htmlreference':
 * @property integer $id
 * @property string $cssframeworkname
 * @property string $htmltype
 * @property string $code
 * @property string $parameters
 * @property string $dummycode
 */
class htmlreference extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return htmlreference the static model class
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
		return 'htmlreference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('htmltype, code, parameters, doc, dummycode, parametersform', 'required'),
			array('cssframeworkname, htmltype', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cssframeworkname, htmltype, code, parameters, doc, dummycode, parametersform', 'safe', 'on'=>'search'),
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
			'cssframeworkname' => 'Cssframeworkname',
			'htmltype' => 'Htmltype',
			'code' => 'Code',
			'parameters' => 'Parameters',
			
			'dummycode' => 'Dummycode',
			
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

		$criteria->compare('cssframeworkname',$this->cssframeworkname,true);

		$criteria->compare('htmltype',$this->htmltype,true);

		$criteria->compare('code',$this->code,true);

		$criteria->compare('parameters',$this->parameters,true);

		//$criteria->compare('doc',$this->doc,true);

		$criteria->compare('dummycode',$this->dummycode,true);

		//$criteria->compare('parametersform',$this->parametersform,true);

		return new CActiveDataProvider('htmlreference', array(
			'criteria'=>$criteria,
		));
	}
         public static function listAllAsOptions()
        {
			 $criteria = new CDbCriteria(array('order'=>'htmltype ASC'));
                         $theme=Yii::app()->session['theme'];

            $models=htmlreference::model()->findAllByAttributes(array('container'=>'n','cssframeworkname'=>$theme),$criteria);
            foreach ($models as $model)
            {
                echo '<option value="'.$model->id.'">'.$model->htmltype.'</option>';
            }
        }
         public static function listAllContainers()
			 
        {
			 $criteria = new CDbCriteria(array('order'=>'htmltype ASC'));

            $models=htmlreference::model()->findAllByAttributes(array('container'=>'y'));
            foreach ($models as $model)
            {
                echo '<option value="'.$model->id.'">'.$model->htmltype.'</option>';
            }
        }
}