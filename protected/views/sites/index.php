<?php
$this->breadcrumbs=array(
	'Sites',
);

$this->menu=array(
	array('label'=>'Create sites', 'url'=>array('create')),
	array('label'=>'Manage sites', 'url'=>array('admin')),
);
?>

<h1>Sites</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
