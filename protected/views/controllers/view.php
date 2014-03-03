<?php
$this->breadcrumbs=array(
	'Controllers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List controllers', 'url'=>array('index')),
	array('label'=>'Create controllers', 'url'=>array('create')),
	array('label'=>'Update controllers', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete controllers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage controllers', 'url'=>array('admin')),
);
?>

<h1>View controllers #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'site_id',
		'name',
		'path',
		'last_updated_at',
	),
)); ?>
