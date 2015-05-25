<?php $this->beginContent('/layouts/main'); ?>
<div class="container">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
	<div id="sidebar">
		<?php $this->widget('TagCloud', array(
			'maxTags'=>Yii::app()->params['tagCloudCount'],
		)); ?>

		<?php $this->widget('RecentComments', array(
			'maxComments'=>Yii::app()->params['recentCommentCount'],
		)); ?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>