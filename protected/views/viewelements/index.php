<?php
/* @var $this ViewelementsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Viewelements',
);

$this->menu=array(
	array('label'=>'Create Viewelements', 'url'=>array('create')),
	array('label'=>'Manage Viewelements', 'url'=>array('admin')),
);
?>

<h1>Viewelements</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
