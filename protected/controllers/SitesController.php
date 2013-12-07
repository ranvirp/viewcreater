<?php

class SitesController extends Controller
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
				'actions'=>array('index','view','getpath','allsites','addsitetosession','allc'),
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
		$model=new sites;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['sites']))
		{
			$model->attributes=$_POST['sites'];
			if($model->save()){
                                populateControllers($model);
				$this->redirect(array('view','id'=>$model->ident));
                        }
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

		if(isset($_POST['sites']))
		{
			$model->attributes=$_POST['sites'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ident));
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
		$dataProvider=new CActiveDataProvider('sites');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new sites('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['sites']))
			$model->attributes=$_GET['sites'];

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
				$this->_model=sites::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='sites-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
                /*
         * Add site name to the session
         */
public function actionAddSiteToSession()
{
    $site_id=$_GET['site_id'];
    Yii::app()->session['site_id']=$site_id;
    $model = Sites::model()->findByPk($site_id);
    print $model->path;
}
public function actionAllSites()
{
    $models = Sites::model()->findAll();
    $str='';
    foreach($models as $model)
    {
        $str.= "<option value='".$model->ident."'>".$model->name."</option>";
    }
    print $str;
}
public function actiongetpath()
{
    $site_id=Yii::app()->session['site_id'];
    if (!$site_id) $site_id=3;
   // $site_id=$_SESSION['site_id'];
    $model = Sites::model()->findByPk($site_id);
    print $model->path;
}
public function actionAllC()
{
    $site_id=Yii::app()->session['site_id'];
    $models = Controllers::model()->findAllByAttributes(array('site_id'=>$site_id));
    $str='';
    foreach($models as $model)
    {
        $str.= "<option value='".$model->id."'>".$model->name."</option>";
    }
    print $str;
}
public function populateControllers()
{
    
}
}
