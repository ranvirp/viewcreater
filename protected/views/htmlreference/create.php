<?php
$this->breadcrumbs=array(
	'Htmlreferences'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List htmlreference', 'url'=>array('index')),
	array('label'=>'Manage htmlreference', 'url'=>array('admin')),
);
?>

<h1>Create htmlreference</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>