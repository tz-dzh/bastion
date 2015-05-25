<?php foreach($applications as $application): ?>
<div class="application" id="a<?php echo $application->id; ?>">

	<div class="author">
		<?php echo $application->authorLink; ?> says:
	</div>

	<?php if('admin' == Yii::app()->user->getState('role')): ?>
		<div class="edit">
			<?php echo CHtml::link("Update", '/bstn/index.php/application/update?id='.$application->id, array(
				'class'=>'aid',
				'title'=>'Permalink to this application',
			));
			echo ' | ';
			echo CHtml::link("Delete", '/bstn/index.php/application/delete?id='.$application->id, array(
				'class'=>'aid',
				'title'=>'Delete this application',
			)); ?>
		</div>
	<?php endif; ?>

	<div class="time">
		<?php echo date('F j, Y \a\t h:i a',$application->create_time); ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($application->content)); ?>
	</div>

</div><!-- application -->
<?php endforeach; ?>