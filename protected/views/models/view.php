<?php
$this->breadcrumbs=array(
	'Models'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List models', 'url'=>array('index')),
	array('label'=>'Create models', 'url'=>array('create')),
	array('label'=>'Update models', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete models', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage models', 'url'=>array('admin')),
);
?>

<h1>View models #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'path',
		'last_updated_at',
	),
)); ?>
