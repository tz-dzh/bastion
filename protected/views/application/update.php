<?php
$this->breadcrumbs=array(
	'Applications'=>array('index'),
	'Update Application #'.$model->id,
);
?>

<h1>Update Application #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>