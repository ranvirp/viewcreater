<?php

/**
 * This is the model class for table "Functions".
 *
 * The followings are the available columns in table 'Functions':
 * @property integer $id
 * @property string $classtype
 * @property integer $classid
 * @property string $name
 * @property string $parameters
 * @property string $code
 * @property string $comments
 * @property integer $status
 * @property string $entry_time
 * @property integer $start_line
 * @property integer $end_line
 */
class Functions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Functions the static model class
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
		return 'Functions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' name,  start_line, end_line', 'required'),
			array('classid, status, start_line, end_line', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('parameters, comments', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,  classid, name, parameters, code, comments, status, entry_time, start_line, end_line', 'safe', 'on'=>'search'),
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
			'classtype' => 'Classtype',
			'classid' => 'Classid',
			'name' => 'Name',
			'parameters' => 'Parameters',
			'code' => 'Code',
			'comments' => 'Comments',
			'status' => 'Status',
			'entry_time' => 'Entry Time',
			'start_line' => 'Start Line',
			'end_line' => 'End Line',
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

		$criteria->compare('classtype',$this->classtype,true);

		$criteria->compare('classid',$this->classid);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('parameters',$this->parameters,true);

		$criteria->compare('code',$this->code,true);

		$criteria->compare('comments',$this->comments,true);

		$criteria->compare('status',$this->status);

		$criteria->compare('entry_time',$this->entry_time,true);

		$criteria->compare('start_line',$this->start_line);

		$criteria->compare('end_line',$this->end_line);

		return new CActiveDataProvider('Functions', array(
			'criteria'=>$criteria,
		));
	}
	public static function replaceFunctionCode($fid,$newCode)
	{
		//get function
		$function = Functions::model()->findByPk($fid);
		$start_line = $function->start_line;
		$end_line = $function->end_line;
		//TODO:check the file on the disk is older or not
		$class= Classes::model()->findByPk($function->classid);
		$path = $class->path;
		copy($path,$path.'.old') or exit("could not make a copy of file");
		$file=fopen($path,"w") or die("could not open $path for writing");
		$lines = explode("\n",$class->code);
		$linecount=1;
		foreach ($lines as $line)
		{
			if ($linecount==$start_line)
			{
				fwrite($file,$newCode."\n");
			}
			if (($linecount<$start_line) || ($linecount>$end_line))
			{
				fwrite($file,$line."\n");
			}
			$linecount++;
		}
		fclose($file);
		SiteImporter::importFile($path);
	}
	/*
	 * ToDO: this function has to be used but not now
	 */
	public static function insertFunction($code,$afterFunction) 
	{
		
		if (is_numeric($afterFunction)) 
		{
			$function = Functions::model()->findByPk($afterFunction);
			if (!$function) {return 0;}
			else 
			{
				
			 $start_line =$function->end_line+1;
			 $class= Classes::model()->findByPk($function->classid);
		$path = $class->path;
		copy($path,$path.'.old') or exit("could not make a copy of file");
		$file=fopen($path,"w") or die("could not open $path for writing");
		$lines = explode("\n",$class->code);
		$linecount=1;
		foreach ($lines as $line)
		{
			if ($linecount==$start_line)
			{
				fwrite($file,$code."\n");
			}
			
				fwrite($file,$line."\n");
			
			$linecount++;
		}
		fclose($file);
		SiteImporter::importFile($path);
		return 1;
			}
		}
		else 
			return 0;
	}
}