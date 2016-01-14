<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php include('MODELE/common_header_include.php'); ?>
		<title><?php echo $lib_manage_blog_05; ?></title>
		<link rel="stylesheet" href="dist/css/validate_style.css"> <!-- Feuille de style : validation saisie formulaire -->
		<link rel="stylesheet" href="dist/css/tagmanager.css"> <!-- Tags CSS -->
		<link rel="stylesheet" href="dist/css/typeahead.css"> <!-- TYPEAHEAD CSS -->
		<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
		<link rel="stylesheet" href="dist/css/examples.css">
	</head>
	<body>
<?php
	if (isset($blog)) { 
		$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="blogs.php">'.$crumb_blogs.'</a></li><li>'.$crumb_editpost.'</li></ul>';
	} else {
		$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="blogs.php">'.$crumb_blogs.'</a></li><li>'.$crumb_post.'</li></ul>';
	}
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
	include('json_get_billes.php');
	if (isset($blog)) { $tags=get_tags($blog['b_post_id']);}
?>
		<div class="container" style="margin-top:70px;">
		<div class="brown-style" style="margin-top:30px">
			<form class="form-horizontal" method="post" action="set_post.php"> <!--//set_text_stop.php -->
				<fieldset>
					<legend align="center"><?php echo $lib_manage_blog_81; ?></legend>
					<input id="post_id" name="post_id" type="hidden" value="<?php echo $blog_id; ?>">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="post_title"><?php echo $lib_manage_blog_20; ?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="post_title" id="post_title" placeholder="<?php echo $lib_manage_blog_25; ?>" value="<?php if (isset($blog['b_post_title'])) {echo $blog['b_post_title'];} ?>" >
						</div>
					</div>
					<br>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="post_title"><?php echo $lib_manage_blog_30; ?></label>
						<div class="col-sm-10">
							<textarea id="idtextarea" name="post_text" rows="10" style="width:100%" placeholder="<?php echo $lib_manage_blog_81; ?>"><?php if (isset($blog['b_post_text'])) { echo $blog['b_post_text']; } ?></textarea>
						</div>
					</div>
<?php if (check_admin()) { ?>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="post_statut"><?php echo $lib_manage_blog_130; ?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="post_statut" id="post_statut" placeholder="<?php echo $lib_manage_blog_140; ?>" value="<?php if (isset($blog['b_statut'])) {echo $blog['b_statut'];} ?>" >
						</div>
					</div>
<?php } ?>
					<br>
					<div class="form-group" style="margin-bottom:20px">
						<label class="col-sm-2 control-label" for="Autocomplete"><?php echo $lib_manage_blog_40; ?></label>
						<div class="col-sm-4">
							<input id="tag_input" class="typeahead" type="text" placeholder="Tags..." onKeyPress="if (event.keyCode == 13) mafonction(event);">
							<input id="hidden_tags" name="hidden_tags" class="typeahead" type="hidden" value="<?php if (isset($blog)) { foreach($tags as $tag) { echo $tag['nom'].'%'; } }?>" >
						</div>
						<div class="demo col-sm-offset-6 ">
							<ul id="taglist" class="tags"><?php
								if (isset($blog)) {
									foreach($tags as $tag) {
										echo '<a  class="mytag" style="margin-top:10px" id="tag'.$tag['b_post_billes_tag_text'].'" href="#">'.$tag['b_post_billes_tag_text'].'</a>
';
									}
								}
							?></ul>
						</div>
					</div>
					<div class="col-sm-12" align="center">
						<button class="btn btn-lg btn-warning " type="submit"><?php echo $lib_manage_blog_100; ?></button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	<script src="dist/js/jquery-1.11.1.js"></script>    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="dist/js/bootstrap.js"></script>		<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="dist/js/bootstrap-tagsinput.js"></script>
	<script src="dist/js/typeahead.bundle.js"></script>
	<script src="dist/js/handlebars.js"></script>
	<script src="dist/js/tinymce.min.js"></script>
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	<script>
		$(document).ready(function(){
	         $('#breadcrumb').jBreadCrumb();
		});
	</script>

		<script type="text/javascript">
			function set_tags() {
				TagsText = $("#taglist").text();
				var MaChaine = replaceAll("\n","%",TagsText);
				if (MaChaine.charAt(MaChaine.length -1) == '%') {
					MaChaine = MaChaine.substring(0, MaChaine.length - 1)
				};
				if (MaChaine.charAt(0) == '%') {
					MaChaine = MaChaine.substring(1, MaChaine.length)
				};
				$('#hidden_tags').val(MaChaine);
				$('#tag_input').val("");
				$('#taglist').on('click','.mytag', function(){
					$(this).remove(); $('#tag_input').val("");
					TagsText = $("#taglist").text();
					var MaChaine2 = replaceAll("\n","%",TagsText);
					if (MaChaine2.charAt(MaChaine2.length -1) == '%') {
						MaChaine2 = MaChaine2.substring(0, MaChaine2.length - 1)
					};
					if (MaChaine2.charAt(0) == '%') {
						MaChaine2 = MaChaine2.substring(1, MaChaine2.length)
					};
					$('#hidden_tags').val(MaChaine2);
				});
			}
		</script>

		<script type="text/javascript">
			$(document).ready(function() {
				var billes = new Bloodhound({
					datumTokenizer: function(d) { 
						return Bloodhound.tokenizers.whitespace(d.val); 
					},
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					limit: 20,
					local: <?php echo get_json_billes(); ?>
				});
				var marques = new Bloodhound({
					datumTokenizer: function(d) { 
						return Bloodhound.tokenizers.whitespace(d.val); 
					},
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					limit: 3,
					local: [{ val: "MEGA" },{ val: "FABRICAS SELECTAS" },{ val: "POTENTIER" },{ val: "MEGA SPAIN" },{ val: "DON JUAN" },{ val: "SHARP SHOOTERS" }]
				});
 
// kicks off the loading/processing of `local` and `prefetch`
				marques.initialize();				
				billes.initialize();
				
				$('#tag_input').typeahead({
					highlight: true
				},
				{
					name: 'billes',
					displayKey: 'val',
					source: billes.ttAdapter(),
					templates: {
						suggestion: Handlebars.compile('<div style="height:25px; vertical-align:middle"><img src="IMAGES/MAIN/THUMBNAIL/{{picture}}.jpg" alt="tags" style="height:25px; margin-right:10px " /><strong>{{val}}</strong></div>')
					}
				},
				{
					name: 'marques',
					displayKey: 'val',
					source: marques.ttAdapter(),
					templates: {
						header: '<div style="background-color:#f0ad4e; height:2px; margin-top:10px; margin-bottom:5px"></div>'
					}
				}				
				);

				$('#tag_input').on('typeahead:selected', function(e){
					var optionSelected = $("option:selected", this);
					var valueSelected = this.value;
					$('#tag_input').val(valueSelected);
					mafonction(e);
				});
				set_tags();
			});
			
		</script>
		<script type="text/javascript">
			function replaceAll(find, replace, str) { return str.replace(new RegExp(find, 'g'), replace);}
			function mafonction(e) { 
				var NewTag = $('#tag_input').val();
				var TagsText = $("#taglist").text();
				var partsArray = TagsText.split('\n');
				$('#hidden_tags').val(TagsText);
				if (partsArray.indexOf(NewTag) != -1) {
					$("#tag"+NewTag).fadeIn(50).fadeOut(50).fadeIn(50).fadeOut(50).fadeIn(50).fadeOut(50).fadeIn(50).fadeOut(50).fadeIn(50);
				}
				else {
					$( "#taglist" ).append( '<a  class="mytag" id="tag'+NewTag.toUpperCase()+'" href="#">'+NewTag.toUpperCase()+'</a>\n' );
					set_tags();
				}
				console.log("|"+TagsText+"|");
				e.preventDefault();
			};
		</script>
		<script type="text/javascript">
tinymce.init({
    selector: "#idtextarea",
    theme: "modern",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});			
		</script>

	</body>
</html>
