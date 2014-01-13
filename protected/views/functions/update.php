<?php
$this->breadcrumbs=array(
	'Functions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List functions', 'url'=>array('index')),
	array('label'=>'Create functions', 'url'=>array('create')),
	array('label'=>'View functions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage functions', 'url'=>array('admin')),
);
?>

<h1>Update functions <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>