<?php
$this->breadcrumbs=array(
	'Models',
);

$this->menu=array(
	array('label'=>'Create models', 'url'=>array('create')),
	array('label'=>'Manage models', 'url'=>array('admin')),
);
?>

<h1>Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
