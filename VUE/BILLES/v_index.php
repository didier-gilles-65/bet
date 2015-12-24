<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_index_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="dist/css/docs.min.css"> <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="dist/css/validate_style.css"> <!-- Feuille de style : validation saisie formulaire -->
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<link rel="stylesheet" href="dist/css/main.css"> <!-- Feuille de style : hover effects -->
	<link rel="stylesheet" href="dist/css/vegas.css">
	<link rel="stylesheet" href="dist/font-awesome-4.4.0/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Cabin+Sketch' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>	
	<link rel="stylesheet" href="dist/css/hover.css">
</head>
<body>

<?php
//	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="liste_billes.php">'.$crumb_liste.'</a></li><li>'.$crumb_detail.'</li></ul>';
    include('MODELE/BLOGS/get_avatar.php'); 
    include('VUE/BILLES/modal-apropos.php');
  //  include('VUE/BILLES/nav-bar-template.php');
?>
	<div id="container-title" style="width:80%"><a href='#' id="tag-titre" class="index-title hvr-buzz" style="opacity:0">NOTHING</a></div>
	<div id="container-body" style="width:80%"><span id="index-body" class="index-body" style="opacity:0">NOTHING</span></div>
	<main id="content" role="main">
<?php	
if (isset($_GET['err']))
{
?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-<?php if (!$_GET['err']) { echo 'success'; } else {echo 'danger';} ?> alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><?php if (!$_GET['err']) { echo $lib_register_170; } else {echo $lib_register_190; } ?></strong>
					<?php if (!$_GET['err']) { echo $lib_register_180; } else {echo $lib_register_200.' : erreur n° '.$_GET['err'].' => '.lireMessageErreur($_GET['err']);} ?>
				</div>
			</div>
		</div>
<?php
}
?>
<?php	
if (isset($_GET['notif']))
{
?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Notif : </strong><?php if (isset($lib_notif[$_GET['notif']])) echo $lib_notif[$_GET['notif']]; else echo $lib_notif["erreur"]; ?>
				</div>
			</div>
		</div>
<?php
}
?>
		<header >
			<div class="container hidden-print" style="background-color:transparent; width:100%; padding-top:40px; padding-bottom:40px; background-size: 2000px" >
				<div class="col-xs-4 col-md-2 center" style="padding:10px">
					<a class="button-title listBtn hvr-pulse-grow" rel="tooltip" data-placement="bottom" title="<?php echo $lib_index_500; ?>" href="liste_billes.php"></a>
				</div>
				<div class="col-xs-4 col-md-2 center" style="padding:10px">
					<a class="button-title blogBtn hvr-pulse-grow" rel="tooltip" data-placement="bottom" title="<?php echo $lib_index_510; ?>" href="blogs.php"></a>
				</div>
				<div class="col-xs-4 col-md-2 center" style="padding:10px">
<?php if ((isset($_SESSION['connect'])) && (isset($_SESSION['email'])) && (isset($_SESSION['gravatar_flag'])) && ($_SESSION['connect'] == 1)) { ?>
					<a href="unsign.php?&page=<?php echo $_SERVER['REQUEST_URI']; ?>"><img class="img-circle  hvr-pulse-grow" style="margin-bottom: 30px; width:100px" id="gravatar" rel="tooltip" data-placement="bottom" title="<?php echo $lib_nav_210; ?>" src="<?php echo get_avatar_link($_SESSION['login'], $_SESSION['email'], $_SESSION['gravatar_flag']);  ?>" alt="..." ></a>
<?php } else {?>
					<a class="button-title loginBtn hvr-pulse-grow" data-toggle="modal" rel="tooltip" data-placement="bottom" title="<?php echo $lib_nav_250;?>" href="#modal_login"></a>
<?php }?>
				</div>
				<div class="col-xs-12 col-md-6" style="height:70px; padding-top:30px">
					<form method="post" action="recherche.php">
						<div class="input-group">
							<input class="search-query form-control" style="height:60px; font-size:150%" placeholder="<?php echo $lib_nav_200;?>" type="text" id="critere" name="critere">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-warning" style="height:60px"><i class="fa fa-search fa-3x"></i></button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</header>		
	</main>
	<!--
	<footer class="bs-footer" style="position: fixed; bottom: 0; width: 100%" role="contentinfo">
      <div class="container-fluid" align="center">
        <div class="row muted bet-footer">
			<p>Copyright &copy; Billes En Tête, 2014 - <?php echo $lib_footer_10;?></p>
         </div>
		<div class="row visible-print" align="right">
			<img src="https://chart.googleapis.com/chart?chs=100x100&amp;cht=qr&amp;chl=http%3A%2F%2Fwww.billes-en-tete.com/liste_billes.php">
        </div>
      </div>
	</footer>
!!>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="dist/js/jquery-1.11.1.min.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/jquery.validate.min.js"></script>
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/billesentete-login-validate.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/vegas.js"></script>
	<script src="dist/js/bootstrap-notify.min.js"></script>
	<script src="dist/js/jquery.textfill.js"></script>

	<script>
		$(function() {
			$('body').vegas({
				timer: false,
				shuffle: true,
				delay: 10000,
				walk: function (index, slideSettings) {
					id_bille = slideSettings.src.substring(slideSettings.src.lastIndexOf('/')+1, slideSettings.src.indexOf('.jpg',0));
					var jqxhr = $.getJSON('/get_json_bille.php'+'?'+'id_bille='+id_bille, function(json){
					})
					.done(function( json ) {
						var my_div_from = $(".index-title:first");
						var my_body_div_from = $(".index-body:first");
						var my_tag_titre = $("#tag-titre");
						var bille_name = json[0]["NOM"];
						var bille_desc = json[0]["DESCRIPTION"];
						my_body_div_from.animate( { opacity: 0 }, 1000 );
						my_div_from.animate(
							{ opacity: 0 },
							1000,
							function() {
								var img_jqxhr = $.getJSON('/get_json_bille_color.php'+'?'+'id_bille='+id_bille, function(img_json){
								})
								.done(function( img_json ) {
									var brightness;
									brightness = (img_json["r"] * 299) + (img_json["g"] * 587) + (img_json["b"] * 114);
									brightness = brightness / 255000;
									if (brightness >= 0.5) {
										title_color = "#000000";
									} else {
										title_color = "#FFFFFF";
									}
									my_div_from[0].style.color = title_color;
									my_div_from[0].innerHTML = bille_name;
									my_body_div_from[0].style.color = title_color;
									my_body_div_from[0].innerHTML = bille_desc;
									$("#container-title").textfill({ 
										maxFontPixels: 120,
										widthOnly: true,
										innerTag:'a',
										debug:true
									});
									my_div_from[0].href = 'detail.php?id='+id_bille;
									my_div_from.animate({opacity: 0.9}, 1000);
									my_body_div_from.animate({opacity: 0.9}, 1000);
									})
								.fail(function( img_jqxhr, textStatus, error ) {
									var err = textStatus + ", " + error;
									$.notify({
										title: '<strong>Erreur!</strong>',
										message: 'Recup couleur '+id_bille+' Erreur : '+err
									},{
										type: 'error'
									});
								});
							}
						);
					})
					.fail(function( jqxhr, textStatus, error ) {
						var err = textStatus + ", " + error;
						$.notify({
							title: '<strong>Erreur!</strong>',
							message: 'Recup image '+id_bille+' Erreur : '.err
						},{
							type: 'error'
						});
					});
					console.log("Slide index " + index + " image " + slideSettings.src + " ["+id_bille+"]");
				},
				slides: [
<?php foreach($billes as $bille) { ?>
					<?php if ( !isset($first) ) {$first=0;} else { echo ','; } ?>
					{ src: "IMAGES/MAIN/HIDEF/<?php if (file_exists('IMAGES/MAIN/HIDEF/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" }
<?php } ?>
				]
			});
		});
	
		$(document).ready(function() {
			$('a').tooltip();
			$('#gravatar').tooltip();
			$('button').tooltip();
		});
	</script>
</body>
</html>
