<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<!--	<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" /> -->
	<?php include('MODELE/common_header_include.php'); ?>

	<title><?php echo $lib_blogs_05; ?></title>
	<link href="dist/css/validate_style.css" rel="stylesheet"> <!-- Feuille de style : validation saisie formulaire -->
	<link href="dist/css/tagmanager.css" rel="stylesheet"> <!-- Tags CSS -->
	<link href="VUE/BILLES/style.css" rel="stylesheet"> <!-- Feuille de style perso -->
	<link href='http://fonts.googleapis.com/css?family=Cabin+Sketch' rel='stylesheet' type='text/css'>
	<!-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
	<link href="/dist/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="dist/css/BreadCrumb.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li>'.$crumb_blogs.'</li></ul>';
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
?>
	<main id="content" role="main">
		<div class="container">
			<div class="row h-padding-normal">
				<div class="col-lg-3 hidden-print">
<?php if ((isset($_SESSION['connect'])) && (isset($_SESSION['utilisateur']))) { ?>
					<div class="brown-style">
						<div class="center">
							<?php if ((isset($_SESSION['connect'])) && (isset($_SESSION['utilisateur']))) { echo '<a href="post.php" class="btn btn-warning btn-lg" style="font-size:100%"><strong>'.$lib_blogs_30.'</strong></a>';} ?></h4>
						</div>
					</div>
<?php } ?>


<ul class="cd-accordion-menu">
	<li class="has-children">
		<input type="checkbox" name ="group-1" id="group-1">
		<label for="group-1">Auteurs</label>
  		<ul>
<?php
	$top_users = get_top_users();
	foreach($top_users as $user)
	{
?>
			<li><a href="blogs.php?user_id=<?php echo $user['b_post_user_id'] ?>"><?php echo $user['login'] ?> (<?php echo $user['rate'] ?>)</a></li>
<?php
	}
?>
  		</ul>


	<li class="has-children">
		<input type="checkbox" name ="group-2" id="group-2">
		<label for="group-2">Tags</label>
   		<ul>

<?php
	$top_tags = get_top_tags();
	foreach($top_tags as $tag)
	{
?>
			<li><a href="blogs.php?tag_name=<?php echo urlencode($tag['b_post_billes_tag_text']) ?>"><?php echo $tag['b_post_billes_tag_text'] ?> (<?php echo $tag['rate'] ?>)</a></li>
<?php
	}
?>							

  		</ul>
	</li>
</ul> <!-- cd-accordion-menu -->
				</div>
				<div class="col-lg-9">
 <?php
	foreach($blogs as $blog)
	{
		$tags=get_tags($blog['b_post_id']);
		$letter_month = '';
		switch (date("m", strtotime($blog['b_post_date']))) {
			case 1: $letter_month = $lib_mois_01; break;
			case 2: $letter_month = $lib_mois_02; break;
			case 3: $letter_month = $lib_mois_03; break;
			case 4: $letter_month = $lib_mois_04; break;
			case 5: $letter_month = $lib_mois_05; break;
			case 6: $letter_month = $lib_mois_06; break;
			case 7: $letter_month = $lib_mois_07; break;
			case 8: $letter_month = $lib_mois_08; break;
			case 9: $letter_month = $lib_mois_09; break;
			case 10: $letter_month = $lib_mois_10; break;
			case 11: $letter_month = $lib_mois_11; break;
			case 12: $letter_month = $lib_mois_12; break;
			default: $letter_month = 'Vendémiaire'; break;
		};
?>
					<div class="row h-padding-normal h-margin-normal" style="background-color:#FFFCF2; margin-bottom:100px;">
						<div class="col-xs-1"> <!-- COLONNE GAUCHE ! -->
							<div class="visible-print"> <!-- IMPRESSION SEULEMENT ! -->
								<img class="img-circle" style="width:50px;" src="<?php echo get_avatar_link($blog['b_post_user_id'], $blog['b_post_user_email'], $blog['b_post_user_gravatar_flag']);  ?>" alt="..." >
							</div>
							<div class="hidden-print"> <!-- ECRAN SEULEMENT ! -->
								<img class="img-circle" style="width:50px;" src="<?php echo get_avatar_link($blog['b_post_user_id'], $blog['b_post_user_email'], $blog['b_post_user_gravatar_flag']);  ?>" alt="..." >
							</div>
						</div>
						<div class="col-xs-11"> <!-- COLONNE DROITE ! -->
							<div class="col-xs-6">
								<p style="font-size:80%">
									<i class="fa fa-calendar fa-lg"></i>  <?php echo $lib_index_230; ?><?php echo date("d", strtotime($blog['b_post_date'])).' '.$letter_month.' '.date("Y", strtotime($blog['b_post_date'])) ; ?>
									<?php echo $lib_blogs_50; ?> <a href="blogs.php?user=<?php echo $blog['login_blog'] ?>"><?php echo $blog['login_blog'] ?><?php if ((isset($login)) && ($blog['login_blog'] == $login)) { echo '<span style="color:red">'.$lib_index_221.'</span>';} ?></a>
								</p>
							</div>
<?php
		$comments = get_comments($blog['b_post_id']);
		foreach($comments as $comment)
		{
			$last_comment_date = $comment['b_comment_date'];
		}
		if ( count($comments) > 1 ) {
?>
						<div class="col-xs-6 text-right" style="font-size:80%; color:#333">
							<i class="fa fa-comments fa-lg"></i>  <strong><?php echo count($comments) ?> <?php echo $lib_blogs_61; ?>,</strong>
							<span> <?php echo $lib_blogs_71; ?> </span>
									<?php if (time() - strtotime($comment['b_comment_date']) < 36000) echo '<span class="label label-warning" style="font-size:80%"><i class="glyphicon glyphicon-fire"></i></span>'; ?>
									<?php echo date("d/m/Y", strtotime($comment['b_comment_date'])) ?>
									<?php echo $lib_index_231; ?>
									<?php echo date("H:i:s", strtotime($comment['b_comment_date'])) ?>
							</small>
						</div>
 <?php
		}
		else {
			if ( count($comments) == 1 ) {
?>
						<div class="col-xs-6 text-right" style="font-size:80%; color:#333">
							<i class="fa fa-comment fa-lg"></i>  <strong>1 <?php echo $lib_blogs_60; ?>, </strong>
								<?php if (time() - strtotime($comment['b_comment_date']) < 36000) echo '<span class="label label-warning" style="font-size:80%"><i class="glyphicon glyphicon-fire"></i></span>'; ?>
								<?php echo $lib_index_230; ?>
								<?php echo date("d/m/Y", strtotime($comment['b_comment_date'])) ?>
								<?php echo $lib_index_231; ?>
								<?php echo date("H:i:s", strtotime($comment['b_comment_date'])) ?>
							</small>
						</div>
 <?php
			}
			else {
?>
						<div class="col-xs-6 text-right" style="font-size:80%; color:#333">
							<i class="fa fa-comments fa-lg"></i>  <strong><?php echo $lib_blogs_62; ?></strong>
							</small>
						</div>
 <?php
			}
		}
?>
							<div class="col-xs-12">
								<span class="blogs-title"><strong><?php echo $blog['b_post_title'] ?></strong></span>
							</div>

							<div class="col-xs-2 visible-print">
								<small>
									<?php echo date("d", strtotime($blog['b_post_date'])).' '.$letter_month.' '.date("Y", strtotime($blog['b_post_date'])) ; ?>
								</small>
							</div>
							<div class="col-xs-12">
								<div style="margin-top:30px font-size:80%">
<?php
		foreach($tags as $tag)
		{
			if ( $tag['b_post_billes_billes_num'] > 0) {
				echo '<img src="IMAGES/MAIN/HIDEF/'.$tag['b_post_billes_billes_num'].'.jpg" alt="tags" style="width:10%; float:left; margin-right:10px" />';
			}
		}
		echo '<div class="dotty" style="max-height:100px; overflow:hidden;" id="blog_div_'.$blog['b_post_id'].'">'.$blog['b_post_text'].'</div>';
?>
									<ul class="pagination pagination-sm">
										<li><?php echo '<a href="blog.php?post_id='.$blog['b_post_id'].'" role="button" >'.$lib_blogs_80.'</a>'; ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
<?php
	}
?>
				</div>
			</div>
			<hr>
		</div>
	</main>

<?php include_once('VUE/BILLES/footer-template.php'); ?>

		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
    <script src="dist/js/jquery-1.11.1.min.js"></script>-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/jquery-1.11.1.min.js"></script>-->
	<script src="dist/js/jquery.dotdotdot.js" type="text/javascript" language="JavaScript"></script>
    <script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/jquery.validate.min.js"></script>
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/billesentete-login-validate.js" type="text/javascript" language="JavaScript"></script>

	<script>
		$(document).ready(function(){
	         $('.dotty').dotdotdot({
			 ellipsis	: ' ... ',
			 tolerance	: 0,
			 watch		: true
			 });
		});
	</script>
	
	<script>
		$(document).ready(function(){
	         $('#breadcrumb').jBreadCrumb();
		});
	</script>

	<script>
		$(function (){
			$('a').tooltip();
		});
	</script>
</body>
</html>
