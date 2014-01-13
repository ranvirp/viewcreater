<?php

class ModelsController extends Controller
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
				'actions'=>array('index','view'),
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
		$model=new models;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['models']))
		{
			$model->attributes=$_POST['models'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['models']))
		{
			$model->attributes=$_POST['models'];
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
		$dataProvider=new CActiveDataProvider('models');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new models('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['models']))
			$model->attributes=$_GET['models'];

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
				$this->_model=models::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='models-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionShowAttributes()
	{
		error_reporting(E_ERROR);
		$modelId=$_GET['model'];
		$model=  Classes::model()->findByPk($modelId);
		
		$siteId = $model->siteid;
		$site=Sites::model()->findByPk($siteId);
		$code = "class yii" . $siteId . " extends YiiBase1 {}";
		eval($code);
		
		//$config = "/Users/mac/htdocs/viewcreater/protected/config/main.php";
		$config = $site->config;
		$yii;
		eval("\$yii=yii$siteId::createWebApplication(\$config);");
		$basePath = YiiBase1::app()->basePath;
		$thispath=$model->path;
		$filecontents = file_get_contents($thispath);
				/*
				$filecontents = "<?php namespace tempimporter$siteId; ?>".$filecontents; 
				 * 
				 */
				$className=  $model->name;
				//print "here\n";
				$filecontents=preg_replace('/class\s+'.$className.'\s+extends\s+CActiveRecord/',"class tempimporter$siteId$className extends CActiveRecord1",$filecontents);
$filecontents=preg_replace("/Yii::/","YiiBase1::",$filecontents);				
//echo $filecontents;
				//exit;
				file_put_contents("tempimporter$siteId$className.php",$filecontents);
				eval("class CActiveRecord1 extends CActiveRecord{function getDbConnection(){return YiiBase1::app()->db;}}");
				eval($filecontents);
			$olddb = CActiveRecord::$db;
			CActiveRecord1::$db=  YiiBase1::app()->db;
		 eval("\$x= tempimporter$siteId$className::model()->getMetaData();");
		 unlink("tempimporter$siteId$className.php");
		 //CActiveRecord::$db=$olddb;
		 $str="<table>\n";
		 $str.="<tr><th>Name</th><th>Type</th><th>DBType</th><th>Size</th></tr>";
		 foreach($x->columns as $column=>$details)
		 {
		   $str.="<tr><td>".$column."</td><td>".$details->type."</td><td>".$details->dbType."</td><td>".$details->size."</td></tr>\n";
		 }
		 $str.="</table>";
		 print $str;
			 
		 
	}
}
