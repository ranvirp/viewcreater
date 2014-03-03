<?php
$this->breadcrumbs=array(
	'Functions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List functions', 'url'=>array('index')),
	array('label'=>'Create functions', 'url'=>array('create')),
	array('label'=>'Update functions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete functions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage functions', 'url'=>array('admin')),
);
?>

<h1>View functions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'controller',
		'order',
		'name',
		'parameters',
		'code',
		'comments',
		'status',
		'entry_time',
	),
)); ?>
