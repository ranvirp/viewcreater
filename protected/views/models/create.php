<?php
$this->breadcrumbs=array(
	'Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List models', 'url'=>array('index')),
	array('label'=>'Manage models', 'url'=>array('admin')),
);
?>

<h1>Create models</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>