<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<!--	<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" /> -->
	<?php include('MODELE/common_header_include.php'); ?>
	<title><?php echo $lib_blogs_05; ?></title>
	<link href="dist/css/validate_style.css" rel="stylesheet"> <!-- Feuille de style : validation saisie formulaire -->
	<link rel="stylesheet" href="dist/css/tagmanager.css"> <!-- Tags CSS -->
	<link href="VUE/BILLES/style.css" rel="stylesheet"> <!-- Feuille de style perso -->
	<link href='http://fonts.googleapis.com/css?family=Cabin+Sketch' rel='stylesheet' type='text/css'>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="blogs.php">'.$crumb_blogs.'</a></li><li>'.$crumb_blog.'</li></ul>';
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
?>
	<main id="content" role="main">
		<div class="container">
 <?php
	{
		$tags=get_tags($blog['b_post_id']);
		$letter_month = '';
		switch (date("m", strtotime($blog['b_post_date']))) {
			case 1: $letter_month = $lib_mois_01; break; case 2: $letter_month = $lib_mois_02; break; case 3: $letter_month = $lib_mois_03; break; case 4: $letter_month = $lib_mois_04; break; case 5: $letter_month = $lib_mois_05; break; case 6: $letter_month = $lib_mois_06; break; case 7: $letter_month = $lib_mois_07; break; case 8: $letter_month = $lib_mois_08; break; case 9: $letter_month = $lib_mois_09; break; case 10: $letter_month = $lib_mois_10; break; case 11: $letter_month = $lib_mois_11; break; case 12: $letter_month = $lib_mois_12; break; default: $letter_month = 'Vendémiaire'; break;
		};
?>
			<div class="row h-padding-normal h-margin-normal" style="background-color:#FFFCF2; margin-bottom:30px; height:50px">
				<div class="col-xs-2 visible-print"> <!-- IMPRESSION SEULEMENT ! -->
					<img class="img-circle" style="width:50px;" src="<?php echo get_avatar_link($blog['b_post_user_id'], $blog['b_post_user_email'], $blog['b_post_user_gravatar_flag']);  ?>" alt="..." >
				</div>
				<div class="col-xs-12 col-sm-2 hidden-print"> <!-- ECRAN SEULEMENT ! -->
					<img class="img-circle" style="width:100px;" src="<?php echo get_avatar_link($blog['b_post_user_id'], $blog['b_post_user_email'], $blog['b_post_user_gravatar_flag']);  ?>" alt="..." >
				</div>
				<div class="col-xs-12 col-sm-8 hidden-print" align="center"> <!-- ECRAN SEULEMENT ! -->
					<p style="font-size:120%">
						<i class="fa fa-calendar fa-lg"></i>  <?php echo $lib_index_230; ?><?php echo date("d", strtotime($blog['b_post_date'])).' '.$letter_month.' '.date("Y", strtotime($blog['b_post_date'])) ; ?>
						<?php echo $lib_blogs_50; ?> <a href="blogs.php?user=<?php echo $blog['login_blog'] ?>"><?php echo $blog['login_blog'] ?><?php if ((isset($login)) && ($blog['login_blog'] == $login)) { echo '<span style="color:red">'.$lib_index_221.'</span>';} ?></a>
					</p>
				</div>
				<div class="col-xs-12 col-sm-2 hidden-print" align="center"> <!-- ECRAN SEULEMENT ! -->
				
<?php if ((isset($_SESSION['connect'])) && (isset($_SESSION['utilisateur'])) && ((isset($_SESSION['profile'])) && ($_SESSION['profile'] == 'ADMIN') || ($_SESSION['utilisateur'] == $blog['login_blog']) ) ) { ?>
					<ul class="pagination pagination-sm" style="margin:0px">
						<li><?php echo '<a href="post.php?post_id='.$blog['b_post_id'].'" role="button" >'.$lib_detail_07.'</a>'; ?></li>
					</ul>
<?php } ?>
				</div>
			</div>
			<div class="row h-padding-normal h-margin-normal" style="background-color:#FFFCF2; margin-bottom:30px;">
				<div class="col-xs-12  blog-title">
					<span><?php echo $blog['b_post_title'] ?></span>
				</div>
			</div>

			<div class="col-xs-2 visible-print">
				<small>
					<?php echo date("d", strtotime($blog['b_post_date'])).' '.$letter_month.' '.date("Y", strtotime($blog['b_post_date'])) ; ?>
				</small>
			</div>
			<div class="col-xs-12 visible-print">
				<small>
					<em>
						<hr/>
						<ul id="tag-list-print" class="list-inline">
<?php
		foreach($tags as $tag) {
			echo '<li>'.$tag['b_post_billes_tag_text'].'</li>';
		}
?>
						</ul>
					</em>
				</small>
			</div>
<?php if(count($tags)>0) { ?>
			<div class="col-xs-12 hidden-print">
				<ul id="tag-list" class="tags">
<?php
	foreach($tags as $tag) {
		echo '<a  class="tag" style="margin-top:10px" id="tag'.$tag['b_post_billes_tag_text'].'" href="#">'.$tag['b_post_billes_tag_text'].'</a>';
	}
?>
				</ul>
			</div>
<?php } ?>
			
			<div class="row">
				<hr style="border-color:#f0ad4e; clear:both; "/>
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
		echo $blog['b_post_text']
?>
				</div>
			</div>
			<hr style="border-color:#f0ad4e; clear:both; "/>
                <!-- the comment box -->
			<div class="hidden-print" style="background-color:#FFFCF2	; margin-left:0px; margin-right:0px; margin-bottom:50px; padding:15px">
<?php
		if ((isset($_SESSION['connect'])) && (isset($_SESSION['utilisateur']))) {
?>
				<div class="row">
					<form action="create_comment.php" method="post">
						<div class="col-xs-9 col-sm-offset-1">
							<textarea class="form-control" id="new_comment" name="new_comment" rows="3"></textarea>
						</div>
						<input type="hidden" name="user_id" value="<?php if (isset($login)) { echo $login;} ?>" />
						<input type="hidden" name="post_id" value="<?php echo $blog['b_post_id']; ?>" />
						<input type="hidden" name="from" value="0" />
						<input type="hidden" name="page" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
						<div class="col-xs-2">
							<button type="submit" class="btn btn-warning center-block"><?php echo $lib_index_241; ?></button>
						</div>
					</form>
				</div>
<?php
		} else {
?>
				<span><a href="login.php"><?php echo $lib_index_250; ?></a><?php echo $lib_index_251; ?></span>
<?php
		}
?>
			</div>
 <?php
		$comments = get_comments($blog['b_post_id']);
		foreach($comments as $comment)
		{
?>
<!-- the comments -->
			<div class="panel panel-warning">
				<div class="panel-heading small-padding">
					<a class="pull-left" href="#" style="margin-right:10px"> <!-- Panel Blog : widget AVATAR du blog -->
						<img class="media-object" src="<?php echo get_avatar_link($comment['b_comment_user_id'], $comment['b_comment_user_email'], $comment['b_comment_user_gravatar_flag']); ?>" alt="..." style="height:100%;">
					</a>
					<strong><?php echo $comment['login_comment'] ?></strong> ,<?php if ((isset($login)) && ($comment['login_comment'] == $login)) { echo '<span style="color:red">'.$lib_index_221.'</span>';} ?>
					<small style="color:#333">
						<?php if (time() - strtotime($comment['b_comment_date']) < 36000) echo '<span class="label label-warning" style="font-size:80%"><i class="glyphicon glyphicon-fire"></i></span>'; ?>
						<?php echo $lib_index_230; ?>
						<?php echo date("d/m/Y", strtotime($comment['b_comment_date'])) ?>
						<?php echo $lib_index_231; ?>
						<?php echo date("H:i:s", strtotime($comment['b_comment_date'])) ?>
					</small>
				</div>
				<div class="panel-body">
					<p><?php echo $comment['b_comment_text'] ?></p>
				</div>
			</div>
<?php
		}
?>
		</div>
<?php
	}
?>
		<hr>
	</main>

<?php include_once('VUE/BILLES/footer-template.php'); ?>

		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="dist/js/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/jquery.validate.min.js"></script>
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/billesentete-login-validate.js" type="text/javascript" language="JavaScript"></script>
	
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
