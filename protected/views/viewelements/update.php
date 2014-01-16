<?php
/* @var $this ViewelementsController */
/* @var $model Viewelements */

$this->breadcrumbs=array(
	'Viewelements'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Viewelements', 'url'=>array('index')),
	array('label'=>'Create Viewelements', 'url'=>array('create')),
	array('label'=>'View Viewelements', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Viewelements', 'url'=>array('admin')),
);
?>

<h1>Update Viewelements <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>