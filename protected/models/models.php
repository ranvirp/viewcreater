<?php

/**
 * This is the model class for table "models".
 *
 * The followings are the available columns in table 'models':
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property string $last_updated_at
 */
class models extends CActiveRecord
{
    
	/**
	 * Returns the static model of the specified AR class.
	 * @return models the static model class
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
		return 'models';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, name, path, last_updated_at', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, path, last_updated_at', 'safe', 'on'=>'search'),
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

		$criteria->compare('name',$this->name,true);

		$criteria->compare('path',$this->path,true);

		$criteria->compare('last_updated_at',$this->last_updated_at,true);

		return new CActiveDataProvider('models', array(
			'criteria'=>$criteria,
		));
	}
        public static function importModelFile() 
        {
            $fileName = "/Users/mac/htdocs/rdp/protected/models/Designation.php";
            $className = "Designation";
            $file  = fopen($fileName,"r");
            if (!$file) 
            {
                echo  "Could not open file $fileName \n";
                exit(1);
            }
            require_once $fileName;
            $x = new ReflectionClass($className);
           // print_r($x->getMethod("saveAttributes"));
            // $method = new ReflectionFunction("saveAttributes");
            //http://stackoverflow.com/questions/19653881/how-get-code-of-method-in-class?lq=1
            //preg_match_all('/function[^\{]+\{(.*)\}/Ux', file_get_contents('SiteController.php'), $matches);
            //
             $res = new ReflectionMethod('Designation', 'saveAttributes');
    $start = $res->getStartLine();
$end = $res->getEndLine();
$file = $res->getFileName();

echo 'get from '.$start.' to '.$end .' from file '.$file.'<br/>';
$lines = file($file);
$fct = '';
for($i=$start;$i<$end+1;$i++)
{
    $num_line = $i-1; // as 1st line is 0
    $fct .= $lines[$num_line];
}
echo '<pre>';
echo $fct;
             exit;
             $func =$method1;
$filename = $func->getFileName();
print $filename. "\n";exit;
$start_line = $func->getStartLine() - 1; // it's actually - 1, otherwise you wont get the function() block
$end_line = $func->getEndLine();
$length = $end_line - $start_line;

$source = file($filename);
$body = implode("", array_slice($source, $start_line, $length));
print_r($body);
exit;
           // print $method1->getEndLine();exit;
            foreach ($x->getMethods() as $method) {
                
                
print_r($x->getMethod($method->name));
           }
        }
        
}