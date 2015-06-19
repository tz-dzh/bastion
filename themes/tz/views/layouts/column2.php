<?php $this->beginContent('/layouts/main'); ?>
<div id="content">
	<div class="container">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div id="sidebar">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<?php $this->widget('TagCloud', array(
					'maxTags'=>Yii::app()->params['tagCloudCount'],
				)); ?>
			</div>
			<div class="col-lg-6">
				<?php $this->widget('RecentComments', array(
					'maxComments'=>Yii::app()->params['recentCommentCount'],
				)); ?>
			</div>
		</div>
	</div>
</div><!-- sidebar -->
<?php $this->endContent(); ?>