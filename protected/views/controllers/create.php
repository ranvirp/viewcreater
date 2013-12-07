<?php
$this->breadcrumbs=array(
	'Controllers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List controllers', 'url'=>array('index')),
	array('label'=>'Manage controllers', 'url'=>array('admin')),
);
?>

<h1>Create controllers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>