<?php
$this->breadcrumbs=array(
	'Htmlreferences',
);

$this->menu=array(
	array('label'=>'Create htmlreference', 'url'=>array('create')),
	array('label'=>'Manage htmlreference', 'url'=>array('admin')),
);
?>

<h1>Htmlreferences</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
