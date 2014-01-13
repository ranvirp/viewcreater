<?php

class VcController extends Controller
{
	public function actionIndex()
	{
		$this->render('interface');
	}
        public function actionTest()
	{
	$gridDataProvider = new CArrayDataProvider(
                array(
    array('id'=>1, 'firstName'=>'Mark', 'lastName'=>'Otto', 'language'=>'<span class="badge badge-warning">HTML</span>','usage'=>'<span class="inlinebar">1,4,4,7,5,9,10</span>'),
    array('id'=>2, 'firstName'=>'Jacob', 'lastName'=>'Thornton', 'language'=>'<span class="badge badge-important">CSS</span>','usage'=>'<span class="inlinebar">1,4,4,7,5,9,10</span>'),
    array('id'=>3, 'firstName'=>'Stu', 'lastName'=>'Dent', 'language'=>'<span class="badge badge-info">Javascript</span>','usage'=>'<span class="inlinebar">1,4,4,7,5,9,10</span>'),
));	
            $this->render('test',array('griddataprovider'=>$gridDataProvider));
	}
        public function actionCreateView()
        {
            //$this->render('bootstraplib');
            $string=$this->renderPartial('bootstraplib',null,true);
            $themePath='/Applications/XAMPP/htdocs/viewcreater/themes/abound/views/vc/test.php';
            file_put_contents($themePath,$string);
            // $string;
        }

	// -----------------------------------------------------------
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}