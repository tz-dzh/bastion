<?php
/*$deleteJS = <<<DEL
$('.container').on('click','.time a.delete',function() {
	var th=$(this),
		container=th.closest('div.comment'),
		id=container.attr('id').slice(1);
	if(confirm('Are you sure you want to delete comment #'+id+'?')) {
		$.ajax({
			url:th.attr('href'),
			type:'POST'
		}).done(function(){container.slideUp()});
	}
	return false;
});
DEL;
Yii::app()->getClientScript()->registerScript('delete', $deleteJS);*/
?>
<div class="application" id="a<?php echo $data->id; ?>">

	<?php echo CHtml::link("#{$data->id}", $data->url, array(
		'class'=>'cid',
		'title'=>'Permalink to this application',
	)); ?>

	<div class="author">
		<?php echo $data->authorLink; ?> says on
		<?php echo CHtml::link(CHtml::encode($data->post->title), $data->post->url); ?>
	
	</div>

	<div class="edit">
		<?php echo CHtml::link('Update',array('application/update','id'=>$data->id)); ?> |
		<?php echo CHtml::link('Delete',array('application/delete','id'=>$data->id),array('class'=>'delete')); ?> |
	</div>

	<div class="time">
		<?php /*if($data->status==Comment::STATUS_PENDING): ?>
			<span class="pending">Pending approval</span> |
			<?php echo CHtml::linkButton('Approve', array(
				'submit'=>array('comment/approve','id'=>$data->id),
			)); ?> |
		<?php endif;*/ ?>
		<?php echo date('F j, Y \a\t h:i a',$data->create_time); ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($data->content)); ?>
	</div>

</div><!-- application -->