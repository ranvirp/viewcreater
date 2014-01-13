<?php
$this->breadcrumbs=array(
	'Controllers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List controllers', 'url'=>array('index')),
	array('label'=>'Create controllers', 'url'=>array('create')),
	array('label'=>'View controllers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage controllers', 'url'=>array('admin')),
);
?>

<h1>Update controllers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>