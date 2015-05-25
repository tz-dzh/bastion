<?php $manage_posts_text=Yii::app()->user->checkAccess('updatePost')?'Manage Posts':'Manage My Posts'; ?>
<ul>
	<li><?php echo CHtml::link('Create New Post',array('post/create')); ?></li>
	<li><?php echo CHtml::link($manage_posts_text,array('post/admin')); ?></li>
	<?php if(!Yii::app()->user->isGuest && 'admin' == Yii::app()->user->getState('role'))
		echo '<li>'.CHtml::link('Create New Event',array('event/create')).'</li>'; ?>
	<?php //if(!Yii::app()->user->isGuest && 'admin' == Yii::app()->user->getState('role'))
		echo '<li>'.CHtml::link('Manage Events',array('event/admin')).'</li>'; ?>
	<?php if(!Yii::app()->user->isGuest && 'admin' == Yii::app()->user->getState('role'))
		echo '<li>'.CHtml::link('Manage Users',array('user/admin')).'</li>'; ?>
	<li><?php echo CHtml::link('Approve Comments',array('comment/index')) . ' (' . Comment::model()->pendingCommentCount . ')'; ?></li>
	<li><?php echo CHtml::link('Logout',array('site/logout')); ?></li>
</ul>