<?php global $odd;
if(!$odd)
	$odd	=	TRUE;
else
	$odd	=	FALSE; ?>
<div class="row featurette">
	<div class="col-md-7<?php if($odd) echo ' col-md-push-5'; ?>">
		<h2 class="featurette-heading">
			<?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?>
		</h2>
		<div class="author">
			posted by <?php echo $data->author->username . ' on ' . date('F j, Y',$data->create_time); ?>
		</div>
		<p class="lead">
			<?php
				$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
				echo $data->content;
				$this->endWidget();
			?>
		</p>
		<div class="nav">
			<b>Tags:</b>
			<?php echo implode(', ', $data->tagLinks); ?>
			<br/>
			<?php echo CHtml::link('Permalink', $data->url); ?> |
			<?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
			Last updated on <?php echo date('F j, Y',$data->update_time); ?>
		</div>
	</div>
	<div class="col-md-5<?php if($odd) echo ' col-md-pull-7'; ?>">
		<img data-holder-rendered="true" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE5MC4zMjUwMDA3NjI5Mzk0NSIgeT0iMjUwIiBzdHlsZT0iZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjIzcHQ7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NTAweDUwMDwvdGV4dD48L2c+PC9zdmc+" class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="500x500">
	</div>
</div>

<hr class="featurette-divider">