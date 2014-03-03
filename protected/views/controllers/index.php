<?php
$this->breadcrumbs=array(
	'Controllers',
);

$this->menu=array(
	array('label'=>'Create controllers', 'url'=>array('create')),
	array('label'=>'Manage controllers', 'url'=>array('admin')),
);
?>

<h1>Controllers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
