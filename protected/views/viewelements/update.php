<?php
$this->breadcrumbs=array(
	'Viewelements'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List viewelements', 'url'=>array('index')),
	array('label'=>'Create viewelements', 'url'=>array('create')),
	array('label'=>'View viewelements', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage viewelements', 'url'=>array('admin')),
);
?>

<h1>Update viewelements <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>