<?php

class HtmlreferenceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules1()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','value'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new htmlreference;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['htmlreference']))
		{
			$model->code=$_POST['htmlreference']['code'];
                        $model->parameters=$_POST['htmlreference']['parameters'];
                        $model->htmltype=$_POST['htmlreference']['htmltype'];
                        $model->dummycode=$_POST['htmlreference']['dummycode'];
                        $model->container=$_POST['htmlreference']['container'];
                        $model->cssframeworkname=$_POST['htmlreference']['cssframeworkname'];
                        
                        
                        
			if($model->save())
                            $model = new htmlreference;
                        
				//$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['htmlreference']))
		{
			$model->code=$_POST['htmlreference']['code'];
                        $model->parameters=$_POST['htmlreference']['parameters'];
                        $model->htmltype=$_POST['htmlreference']['htmltype'];
                        $model->dummycode=$_POST['htmlreference']['dummycode'];
                        $model->id=$_POST['htmlreference']['id'];
                        $model->container=$_POST['htmlreference']['container'];
                         $model->cssframeworkname=$_POST['htmlreference']['cssframeworkname'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('htmlreference');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        /**
         * Return value of a a type
         */
         public function actionValue()
         {
             if (isset($_GET['id'])){
                  $id = $_GET['id'];
                  $model = Htmlreference::model()->findByPk($id);
                }
                $x = $model->attributes;
                $x['parameters']=$this->genParameterForm($x['parameters']);
                $x['code']=$model->code;
                $x['dummycode']=$model->dummycode;
                $x['container']=$model->container;
                print CJSON::encode($x);
         }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new htmlreference('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['htmlreference']))
			$model->attributes=$_GET['htmlreference'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=htmlreference::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='htmlreference-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        function genParameterForm($string)
        {
            //$matches=array();
           // var_dump($string);
            //exit;
            if (!is_array($string))
            eval("\$string=$string;");
            $str='';
           // $string=array("a:Arami" , "'b:Bharat', ('x','y','z')",array("d:Arami" , "'b:Bharat', ('x','y','z')"));
            foreach ($string as $s)
            {
                if (is_array($s)){
                    $str.=$this->genMultParameterForm($s);
                    continue;
                }
                if (preg_match('/(.*?),(.*)/',$s,$matches)) 
                {
                    if (preg_match('/([a-zA-Z0-9]+):([a-zA-Z0-9\s]+)(:([a-zA-Z0-9\s]+))*/',$matches[1],$matches2)) {
                        $name=$matches2[1];
                        $label=$matches2[2];
                        $helptext="";
                        if (isset($matches2[4]))
			$helptext=$matches2[4];
                    }
                   
                   $x=$matches[2];
                   eval("\$y=array$x;");
                   $str.='<div class="form-group">';
                   $str.='<label for="%(id)s_'.$name.'">'.$label.'</label>
                          <select  class="form-control parameters" parameter-name='.$name.' parameter-type="%(id)s" >';
                   foreach ($y as $z)
                   {
                       $str.='<option value="'.$z.'">'.$z.'</option>\n';
                       
                   }  
                
                  $str.='</select>';
				  $str.='<p class="help-block">'.$helptext.'</p>';
				  $str.='</div>';
                 // $str.="<script>$('select[parameter-name=$name]').val('%($name)s);</script>";
                   
                   }
                else{
                if (preg_match('/([a-zA-Z0-9]+):([a-zA-Z0-9\s]+)(:([a-zA-Z0-9\s]+))*/',$s,$match)) {
                 //   var_dump($match);
                $str.='<div class="form-group">
              <label for="%(id)s_'.$match[1].'">'.$match[2].'</label>
              <input type="text" class="form-control parameters" parameter-name="'.$match[1].'" parameter-type="%(id)s" 
                placeholder="Enter '.$match[2].'" value="">';
                if (isset($match[4])){
		$str.='		<p class="help-block">'.$match[4].'</p>';
                }
                $str.='</div>';
                
                }
            }
            }
            //var_dump($str);
            return $str;
        }
        function genMultParameterForm($string) 
        {
         // eval("\$string=$string;")  ;
          if (!is_array($string)) return '0';
          $mode=$string[0];
          unset($string[0]);
          $name=$string[1];
          unset($string[1]);
          if (preg_match('/([a-zA-Z0-9]+):([a-zA-Z0-9\s]+)(:([a-zA-Z0-9\s]+)*)/',$name,$matches2)) {
                        $name=$matches2[1];
                        $label=$matches2[2];
						$helptext=$matches2[4];
                    }
         
          if (!is_array($string))
            eval("\$string=$string;");
            $str='';
           // $string=array("a:Arami" , "'b:Bharat', ('x','y','z')",array("d:Arami" , "'b:Bharat', ('x','y','z')"));
            foreach ($string as $s)
            {
                if (is_array($s)){
                    $str.=$this->genMultParameterForm($s);
                    continue;
                }
                if (preg_match('/(.*?),(.*)/',$s,$matches)) 
                {
                    $name1='';
                    $label1='';
                    if (preg_match('/([a-zA-Z0-9]+):([a-zA-Z0-9\s]+)(:([a-zA-Z0-9\s]+))*/',$matches[1],$matches2)) {
                        $name1=$matches2[1];
                        $label1=$matches2[2];
						$helptext1=$matches2[4];
                    }
                   
                   $x=$matches[2];
                   eval("\$y=array$x;");
                  $str.='<div class="col-md-4">';
                   $str.='<label for="%(id)s_'.$name1.'">'.$label1.'</label>
                          <select   p-n="'.$name.'" name="'.$name1.'"parameter-type="%(id)s" >';
                   foreach ($y as $z)
                   {
                       $str.='<option value="'.$z.'">'.$z.'</option>\n';
                       
                   }  
                
                  $str.='</select>';
				   $str.='<p class="help-block">'.$helptext1.'</p>';
				 
                  $str.='</div>';
                 // $str.="<script>$('select[parameter-name=$name]').val('%($name)s);</script>";
                   
                   }
                else{
                if (preg_match('/([a-zA-Z0-9]+):([a-zA-Z0-9\s]+)(:([a-zA-Z0-9\s]+))*/',$s,$match)) {
                 //   var_dump($match);
                    $str.='<div class="col-md-4">';
                $str.='
              <label for="%(id)s_'.$match[1].'">'.$match[2].'</label>
              <input type="text"  p-n="'.$name.'" name="'.$match[1].'"parameter-type="%(id)s" 
                placeholder="Enter '.$match[2].'" value=""\>
                ';
				$str.="<p class='help-block'>$match[4]</p>";
                $str.='</div>';
                }
            }
            }
            
          //$str=str_replace("parameter-name","p-n",$str);
                 
          $str1 = <<<EOT
          
<input class="parameters"  type="hidden" parameter-type="%(id)s" parameter-name="$name"   value='array()'/>
<p class="help-block">$helptext -Press Add Row to add another row </p>
<div class="groupc" mode='$mode'  p-n="$name" count="1"><button onclick='js:addDivHere($(this))'>Add Row</button>
<div class="groupf row" p-n="$name" count="1">
EOT;

return $str1.$str.'</div></div>'."<script>changeinput('$name')</script>";
        }
}
