<?php
$this->breadcrumbs=array(
	$model->username=>$model->email,
	'Update',
);
?>

<h1>Update <i><?php echo CHtml::encode($model->username); ?></i></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>