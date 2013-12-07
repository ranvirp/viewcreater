<?php
$this->breadcrumbs=array(
	'Models'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List models', 'url'=>array('index')),
	array('label'=>'Create models', 'url'=>array('create')),
	array('label'=>'View models', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage models', 'url'=>array('admin')),
);
?>

<h1>Update models <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>