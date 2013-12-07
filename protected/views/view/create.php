<?php
$this->breadcrumbs=array(
	'Views'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List view', 'url'=>array('index')),
	array('label'=>'Manage view', 'url'=>array('admin')),
);
?>

<h1>Create view</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>