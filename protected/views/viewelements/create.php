<?php
$this->breadcrumbs=array(
	'Viewelements'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List viewelements', 'url'=>array('index')),
	array('label'=>'Manage viewelements', 'url'=>array('admin')),
);
?>

<h1>Create viewelements</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>