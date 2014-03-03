<?php
$this->breadcrumbs=array(
	'Sites'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List sites', 'url'=>array('index')),
	array('label'=>'Manage sites', 'url'=>array('admin')),
);
?>

<h1>Create sites</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>