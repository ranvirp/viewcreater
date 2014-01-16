<?php
/* @var $this ViewelementsController */
/* @var $model Viewelements */

$this->breadcrumbs=array(
	'Viewelements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Viewelements', 'url'=>array('index')),
	array('label'=>'Manage Viewelements', 'url'=>array('admin')),
);
?>

<h1>Create Viewelements</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>