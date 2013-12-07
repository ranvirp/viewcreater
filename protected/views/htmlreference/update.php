<?php
$this->breadcrumbs=array(
	'Htmlreferences'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List htmlreference', 'url'=>array('index')),
	array('label'=>'Create htmlreference', 'url'=>array('create')),
	array('label'=>'View htmlreference', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage htmlreference', 'url'=>array('admin')),
);
?>

<h1>Update htmlreference <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>