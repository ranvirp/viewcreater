<?php
$this->breadcrumbs=array(
	'Sites'=>array('index'),
	$model->name=>array('view','id'=>$model->ident),
	'Update',
);

$this->menu=array(
	array('label'=>'List sites', 'url'=>array('index')),
	array('label'=>'Create sites', 'url'=>array('create')),
	array('label'=>'View sites', 'url'=>array('view', 'id'=>$model->ident)),
	array('label'=>'Manage sites', 'url'=>array('admin')),
);
?>

<h1>Update sites <?php echo $model->ident; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>