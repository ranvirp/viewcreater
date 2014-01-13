<?php
$this->breadcrumbs=array(
	'Functions',
);

$this->menu=array(
	array('label'=>'Create functions', 'url'=>array('create')),
	array('label'=>'Manage functions', 'url'=>array('admin')),
);
?>

<h1>Functions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
