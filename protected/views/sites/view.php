<?php
$this->breadcrumbs=array(
	'Sites'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List sites', 'url'=>array('index')),
	array('label'=>'Create sites', 'url'=>array('create')),
	array('label'=>'Update sites', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete sites', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage sites', 'url'=>array('admin')),
);
?>

<h1>View sites #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'path',
		'config',
	),
)); ?>
