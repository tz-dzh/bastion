<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->title,
); ?>

<div id="event">

	<?php $this->menu=array(
		array('label'=>'List Event', 'url'=>array('index')),
		array('label'=>'Create Event', 'url'=>array('create')),
		array('label'=>'Update Event', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete Event', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage Event', 'url'=>array('admin')),
	); ?>

	<h1>View Event #<?php echo $model->id; ?></h1>

	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'title',
			'description',
			'event_time',
			'create_time',
			'update_time',
			//'details',
			'author_id',
		),
	)); ?>

	<?php // Custom fields
	if(!empty($model->details) && is_array($model->details)): ?>
		<table class="detail-view">
			<?php $i = 0;
			foreach ($model->details as $key => $value): ?>
				<tr class="<?php echo $i % 2 ? 'even' : 'odd'; ?>">
					<th><?php echo ucwords(str_replace('_', ' ', $key)); ?></th>
					<td>
						<?php echo $value; ?>
						<?php if('cost' == $key) echo ' UAH'; ?>
					</td>
				</tr>
			<?php $i++;
			endforeach; ?>
		</table>
	<?php endif; ?>

</div>

<!--GMap-->
<?php if(!empty($model->details) && is_array($model->details) && ! empty($model->details['latitude']) && !empty($model->details['longtitude'])): ?>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDnrsbjfBypdGAwtYFFCAdvlwr3eNxgZ4Y&sensor=TRUE"></script>
	<?php $gmap_id	=	'gmap_'.$model->id; ?>
	<div id="map">
		<div id="<?php echo $gmap_id; ?>" class="gmap" style="height: 300px;">
		</div>
	</div>
	<script type="text/javascript">
		function initialize() {
			var mapOptions = {
				center: new google.maps.LatLng(<?php echo $model->details['latitude']; ?>, <?php echo $model->details['longtitude']; ?>),
				zoom: 15,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById("<?php echo $gmap_id; ?>"),
				mapOptions);
		}

		initialize();
	</script>
<?php endif; ?>

<!--gmap-->

<div id="applications">
	<?php $app_authors=array();
	if($model->applicationCount>=1): ?>
		<h3>
			<?php echo $model->applicationCount>1 ? $model->applicationCount . ' applications' : 'One application'; ?>
		</h3>

		<?php $this->renderPartial('_applications',array(
			'event'=>$model,
			'applications'=>$model->applications,
		)); ?>

		<?php 
		foreach ($model->applications as $application) {
			$app_authors[]=$application->author_id;
		} ?>

	<?php endif; ?>

	<?php if(Yii::app()->user->hasFlash('applicationSubmitted')): ?>
		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('applicationSubmitted'); ?>
		</div>
	<?php elseif(!empty($app_authors) && FALSE !== array_search(Yii::app()->user->id, $app_authors)): ?>
		<div class="flash-success">
			<?php echo 'You already left your application to this event.' ?>
		</div>
	<?php else: ?>
		<h3>Leave an Application</h3>
		<?php $this->renderPartial('/application/_form',array(
			'model'=>$application,
		)); ?>
	<?php endif; ?>

</div><!-- applications -->