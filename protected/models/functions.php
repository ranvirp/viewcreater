<?php

/**
 * This is the model class for table "functions".
 *
 * The followings are the available columns in table 'functions':
 * @property integer $id
 * @property string $controller
 * @property integer $order
 * @property string $name
 * @property string $parameters
 * @property string $code
 * @property string $comments
 * @property integer $status
 * @property string $entry_time
 */
class functions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return functions the static model class
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
		return 'functions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('controller, order, name, parameters, code, comments, status, entry_time', 'required'),
			array('order, status', 'numerical', 'integerOnly'=>true),
			array('controller, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, controller, order, name, parameters, code, comments, status, entry_time', 'safe', 'on'=>'search'),
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
			'controller' => 'Controller',
			'order' => 'Order',
			'name' => 'Name',
			'parameters' => 'Parameters',
			'code' => 'Code',
			'comments' => 'Comments',
			'status' => 'Status',
			'entry_time' => 'Entry Time',
		);
	}
        public static function importFile($controller)
        {
            $controllermodel = Controllers::model()->findByPk($controller);
            $filepath = $controllermodel->path.'/'.$controllermodel->name.'Controller.php';
            $models= Functions::model()->findAllByAttributes(array('controller'=>$controller));
            foreach ($models as $model)
                $model->delete();
            
            $str=file_get_contents($filepath);
           // preg_match("/(\/\*.+\/\*)\s+[(public)|(private)|(protected)]\s+(static\s+)*function\s+(.+)\s*\((.*)\)\s+\{(.+)\}/",$str,$matches);
          //  preg_match_all("/(\/\*(.*)\*\/).+[(public)|(private)|(protected)]\s+(static\s+)*function\s+(.+)\s*\((.*)\).*\{(.*)\}/",$str,$matches);
$regex = '~
  function                 #function keyword
  \s+                      #any number of whitespaces 
  (?P<function_name>.*?)   #function name itself
  \s*                      #optional white spaces
  \((?P<parameters>.*?)\)  #function parameters
  \s*                      #optional white spaces
  (?P<body>\{.*\}?)        #body of a function
~six';            
preg_match_all($regex,$str,$matches);
            
            //print_r($matches['body']);
            //exit;
            $new_string;
            for ($i=0;$i<count($matches['body']);$i++)
            {
             $comments='';
              $name = $matches['function_name'][$i];
              $parameters=$matches['parameters'][$i];
              $code=$matches['body'][$i];
              $model = new functions();
              $model->controller=$controller;
              $model->code=$code;
              $model->comments=$comments;
              $model->name=$name;
              $model->parameters=$parameters;
              $model->save();
              $new_string=preg_replace($matches[$i][0],"%($name)s",$str);
              
            }
            $mcontroller=Controllers::model()->findByPk($controller);
            $mcontroller->code=$new_string;
            $mcontroller->save();
            
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

		$criteria->compare('controller',$this->controller,true);

		$criteria->compare('order',$this->order);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('parameters',$this->parameters,true);

		$criteria->compare('code',$this->code,true);

		$criteria->compare('comments',$this->comments,true);

		$criteria->compare('status',$this->status);

		$criteria->compare('entry_time',$this->entry_time,true);

		return new CActiveDataProvider('functions', array(
			'criteria'=>$criteria,
		));
	}
}