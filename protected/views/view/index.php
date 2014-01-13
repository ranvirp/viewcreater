<?php
$this->breadcrumbs=array(
	'Views',
);

$this->menu=array(
	array('label'=>'Create view', 'url'=>array('create')),
	array('label'=>'Manage view', 'url'=>array('admin')),
);
?>

<h1>Views</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
