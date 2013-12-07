<?php
$this->breadcrumbs=array(
	'Viewelements'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List viewelements', 'url'=>array('index')),
	array('label'=>'Create viewelements', 'url'=>array('create')),
	array('label'=>'Update viewelements', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete viewelements', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage viewelements', 'url'=>array('admin')),
);
?>

<h1>View viewelements #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'view_id',
		'elem_id',
		'html',
	),
)); ?>
