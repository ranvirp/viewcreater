<?php
$this->breadcrumbs=array(
	'Htmlreferences'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List htmlreference', 'url'=>array('index')),
	array('label'=>'Create htmlreference', 'url'=>array('create')),
	array('label'=>'Update htmlreference', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete htmlreference', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage htmlreference', 'url'=>array('admin')),
);
?>

<h1>View htmlreference #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'cssframeworkname',
		'htmltype',
		'code',
		'parameters',
		'dummycode',
	),
)); ?>
