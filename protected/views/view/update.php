<?php
$this->breadcrumbs=array(
	'Views'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List view', 'url'=>array('index')),
	array('label'=>'Create view', 'url'=>array('create')),
	array('label'=>'View view', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage view', 'url'=>array('admin')),
);
?>

<h1>Update view <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>