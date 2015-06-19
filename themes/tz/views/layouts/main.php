<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="language" content="en" />

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- blueprint CSS framework -->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />-->

	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/css/bootstrap.min.css" />
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/bootstrap/js/bootstrap.min.js"></script>
	<!-- bootstrap -->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/script.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
	<?php if('post/index' == $this->route): ?>
		<!-- Carousel
		================================================== -->
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class=""></li>
				<li class="" data-target="#myCarousel" data-slide-to="1"></li>
				<li class="active" data-target="#myCarousel" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item">
					<img class="first-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
					<div class="container">
						<div class="carousel-caption">
							<h1>Example headline.</h1>
							<p>Note: If you're viewing this page via a <code>file://</code>
		URL, the "next" and "previous" Glyphicon buttons on the left and right 
		might not load/display properly due to web browser security rules.</p>
							<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
						</div>
					</div>
				</div>
				<div class="item">
					<img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
					<div class="container">
						<div class="carousel-caption">
							<h1>Another example headline.</h1>
							<p>Cras justo odio, dapibus ac facilisis in, egestas eget 
		quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor 
		id nibh ultricies vehicula ut id elit.</p>
							<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
						</div>
					</div>
				</div>
				<div class="item active">
					<img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
					<div class="container">
						<div class="carousel-caption">
							<h1>One more for good measure.</h1>
							<p>Cras justo odio, dapibus ac facilisis in, egestas eget 
		quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor 
		id nibh ultricies vehicula ut id elit.</p>
							<p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
						</div>
					</div>
				</div>
			</div>
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div><!-- /.carousel -->
	<?php endif; ?>

	<div class="navbar-wrapper">
		<div class="container">
			<nav class="navbar navbar-inverse navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<?php echo CHtml::link(Yii::app()->name,array('post/index'),array('class'=>'navbar-brand')); ?>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><?php echo CHtml::link('Events',array('event/index')); ?></li>
							<li><?php echo CHtml::link('About',array('site/page', 'view'=>'about')); ?></li>
							<li><?php echo CHtml::link('Contact',array('site/contact')); ?></li>
							<?php if(!Yii::app()->user->isGuest && Yii::app()->user->checkAccess('createPost')): ?>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Actions <span class="caret"></span></a>
									<?php $manage_posts_text=Yii::app()->user->checkAccess('updatePost')?'Manage Posts':'Manage My Posts'; ?>
									<ul class="dropdown-menu" role="menu">
										<li><?php echo CHtml::link('Create New Post',array('post/create')); ?></li>
										<li><?php echo CHtml::link($manage_posts_text,array('post/admin')); ?></li>
										<?php if(!Yii::app()->user->isGuest && 'admin' == Yii::app()->user->getState('role'))
											echo '<li>'.CHtml::link('Create New Event',array('event/create')).'</li>'; ?>
										<?php //if(!Yii::app()->user->isGuest && 'admin' == Yii::app()->user->getState('role'))
											echo '<li>'.CHtml::link('Manage Events',array('event/admin')).'</li>'; ?>
										<?php if(!Yii::app()->user->isGuest && 'admin' == Yii::app()->user->getState('role'))
											echo '<li>'.CHtml::link('Manage Users',array('user/admin')).'</li>'; ?>
										<li><?php echo CHtml::link('Approve Comments (' . Comment::model()->pendingCommentCount . ')',array('comment/index')); ?></li>
										<li><?php echo CHtml::link('Logout',array('site/logout')); ?></li>
									</ul>
								</li>
							<?php endif; ?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<?php if(Yii::app()->user->isGuest):
								echo '<li>'.CHtml::link('Login',array('site/login')).'</li>';
								echo '<li>'.CHtml::link('Register',array('site/register')).'</li>';
							else:
								echo '<li>'.CHtml::link('Logout ('.Yii::app()->user->name.')',array('site/logout')).'</li>';
							endif; ?>
						</ul>
					</div>
				</div>
			</nav>

		</div>
	</div>

	<?php echo $content; ?>

	<div class="container marketing">
		<footer>
			<p class="pull-right"><a href="#">Back to top</a></p>
			<p>© <?php echo date('Y'); ?> tz.</p>
		</footer>
	</div><!-- /.container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<!--<script src="Carousel%20Template%20for%20Bootstrap_files/jquery.js"></script>
		<script src="Carousel%20Template%20for%20Bootstrap_files/bootstrap.js"></script>-->
		<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
		<!--<script src="Carousel%20Template%20for%20Bootstrap_files/holder.js"></script>-->
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<!--<script src="Carousel%20Template%20for%20Bootstrap_files/ie10-viewport-bug-workaround.js"></script>-->
	

<!--<svg style="visibility: hidden; position: absolute; top: -100%; left: -100%;" preserveAspectRatio="none" viewBox="0 0 500 500" height="500" width="500"><defs></defs><text style="font-weight:bold;font-size:23pt;font-family:Arial, Helvetica, Open Sans, sans-serif;dominant-baseline:middle" y="23" x="0">500x500</text></svg>-->
</body>
</html>