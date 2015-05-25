<?php
$this->breadcrumbs=array(
	'Manage Users',
);
?>
<h1>Manage Users</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'username',
			'type'=>'raw',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
		),
		array(
			'name'=>'role',
			'type'=>'raw',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
