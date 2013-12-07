<?php
$this->breadcrumbs=array(
	'Functions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List functions', 'url'=>array('index')),
	array('label'=>'Manage functions', 'url'=>array('admin')),
);
?>

<h1>Create functions</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>