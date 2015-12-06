<!-- SET_UPDATE_PHOTO_ETIQUETTE.PHP

Mise en page pour UPDATE_PHOTO_ETIQUETTE.PHP

USES : 

TODO:
- Revoir la présentation barre de titre div principal

-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_update_reference_bille_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" type="text/css" href="dist/css/sweet-alert.css">
	<link rel="stylesheet" href="dist/css/hover.css">
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="liste_billes.php">'.$crumb_liste.'</a></li><li><a href="detail.php?id='.$id.'">'.$crumb_detail.'</a></li><li>'.$crumb_update_etiquette.'</li></ul>';
	include('VUE/BILLES/modal-apropos.php');
	include('VUE/BILLES/nav-bar-template.php');
?>
<?php
function in_array_column($text, $column, $array)
{
    if (!empty($array) && is_array($array))
    {
        for ($i=0; $i < count($array); $i++)
        {
            if ($array[$i][$column]==$text || strcmp($array[$i][$column],$text)==0) return true;
        }
    }
    return false;
}
?>
<main>
	<div class="container">
	<!-- Texte haut de page -->
		<input type="hidden" id="id_photo" name="id_photo" value="0">
		<div class="row h-padding-normal"></div>
		<div class="row page-head h-padding-normal">
			<div class="col-xs-12" align="center" style="font-size:250%"><?php if (isset($_GET['libelle'])) { echo $_GET['libelle']; } else { echo 'ERROR'; } ?></div>
			<input type="hidden" id="bmc" name="bmc" value="<?php echo $_GET['bmc']; ?>">
			<input type="hidden" id="input_conditionnement" name="input_conditionnement" value="">
		</div>
		<div class="row pagination-nav">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
				<div id="previews">
					<div class="table table-striped" class="files" >
						<div id="template" class="file-row" align="center" >
   <!-- This is used as the file preview template -->
							<div class="hidden">
								<span class="preview"><img data-dz-thumbnail /></span>
							</div>
							<div class="hidden">
								<p class="name" data-dz-name></p>
								<strong class="error text-danger" data-dz-errormessage></strong>
							</div>
							<div style="width:100%;">
								<p class="size hidden" data-dz-size></p>
								<div class="progress progress-striped active" style="height:3px" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
									<div class="progress-bar progress-bar-success" style="height:3px; width:0%;" data-dz-uploadprogress></div>
								</div>
							</div>
							<div align="center" class="hidden">
								<button class="btn btn-primary start">
									<i class="glyphicon glyphicon-upload"></i>
									<span></span>
								</button>
								<button data-dz-remove class="btn btn-warning cancel">
									<i class="glyphicon glyphicon-ban-circle"></i>
									<span></span>
								</button>
							</div>
						</div>
					</div>					
				</div>

				<div class="panel-body" id="MyPictureDropDiv" >
				</div>
				<div class="col-xs-12 drop-div" id="poubelle" href="#" rel="tooltip" data-placement="right" title="Droppez l'image ici pour la supprimer" align="center">
					<span style="color:'#FF0000'"><?php echo $lib_update_photo_etiquette_10; ?></span>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 hidden">
				<div class="panel panel-success">
					<div class="panel-heading small-padding" id="dropzone"></div>
					<div class="panel-body">
						<div id="actions" >
							<div class="row" align="center">
        <!-- The fileinput-button span is used to style the file input field as button -->
								<span class="btn btn-success fileinput-button hidden">
									<i class="glyphicon glyphicon-plus"></i>
									<span><?php echo $lib_update_reference_bille_520; ?></span>
								</span>
								<button type="submit" class="btn btn-primary start hidden">
									<i class="glyphicon glyphicon-upload"></i>
									<span><?php echo $lib_update_reference_bille_530; ?></span>
								</button>
								<button type="reset" class="btn btn-danger cancel hidden">
									<i class="glyphicon glyphicon-ban-circle"></i>
									<span><?php echo $lib_update_reference_bille_540; ?></span>
								</button>
							</div>
							<div class="row hidden">
		<!-- The global file processing state -->
								<span class="fileupload-process">
									<div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
										<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
									</div>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-sm-offset-3" align="center">
				<hr/>
				<a class="btn btn-lg btn-warning" href="detail.php?id=<?php echo $id; ?>"><?php echo $lib_div_1095; ?></a>
				<hr/>
			</div>
		</div>
	</div>
</main>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="dist/js/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/jquery.blueimp-gallery.min.js"></script>
	<script src="dist/js/blueimp-gallery.min.js"></script>
	<script src="dist/js/dropzone.js"></script>
	<script src="dist/js/sweet-alert.min.js"></script>
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	<script>
		$(document).ready(function(){
	         $('#breadcrumb').jBreadCrumb();
		});
	</script>
	
<script>

$.event.props.push('dataTransfer'); // ajoute la propriété pour le drop et le transfert de données

$(function (){
	$('a').tooltip();
	$("#poubelle").tooltip();
});

$(function(){

	var previewNode = document.querySelector("#template");
	previewNode.id = "";
	var previewTemplate = previewNode.parentNode.innerHTML;
	previewNode.parentNode.removeChild(previewNode);
	$("#input_conditionnement").change(function(){
	
		function nettoie(test){
			var test=document.getElementById('MyPictureDropDiv');
			while(test.hasChildNodes())test.removeChild(test.lastChild); // innerHTML non adapté dans ce cas
		}
		
		function set_img(cellule, s_indice, myURL, file, idphoto) {

			if ( idphoto != 0 ) {
				var img = document.createElement("img");
				img.style.width="100px";
				img.src = file+"?id="+idphoto+"&dummy="+Math.floor((Math.random() * 1000000) + 1);
				img.id="thumb"+s_indice;
				img.setAttribute( "rel","tooltip" );
				img.setAttribute( "data-placement","right" );
				img.setAttribute( "title","Drop or click to update image" );
				cellule.appendChild(img);
				var hidden_mbc = document.createElement("input");
				hidden_mbc.setAttribute( "class","hidden" );
				hidden_mbc.setAttribute( "value", idphoto );
				var rmv_btn = document.createElement("div");
				rmv_btn.setAttribute( "class","button-medium removeBtn hvr-pulse-grow" );
				rmv_btn.onclick = function (event) { 
					swal({
						title: "CONFIRMATION",
						text: "Confirmer Suppression ?",
						showCancelButton: true,
						imageUrl: encodeURI(file),
						confirmButtonColor: "#DD6B55",
						closeOnCancel: false,							
						cancelButtonText: "Annuler",
						closeOnConfirm: false,
						confirmButtonText: "Continuer"
						},
						function(isConfirm){   
							if (isConfirm) {
								var jqxhr = $.getJSON("/delete_json_etiquette.php",{id: idphoto}, function(json){
								})
								.done(function( json ) {
									console.log( "delete_json_etiquette.php" );
									$("#input_conditionnement").change();
								})
								.fail(function( jqxhr, textStatus, error ) {
									var err = textStatus + ", " + error;
									swal({ title: "Erreur lors de la suppression de l'image", text: err, imageUrl: encodeURI(file) });
								})
								swal("Supprimé", "L'image a été supprimée", "success");   
							} 
							else {
								swal("Annulé", "L'image est conservée", "error");   
							}
						}
					);				
				};
				cellule.appendChild(hidden_mbc);
				cellule.appendChild(rmv_btn);
			}
			else
			{
				var add_btn = document.createElement("div");
				add_btn.setAttribute( "class","button-medium addBtn hvr-pulse-grow" );
				add_btn.id="thumb"+s_indice;
				add_btn.setAttribute( "rel","tooltip" );
				add_btn.setAttribute( "data-placement","right" );
				add_btn.setAttribute( "title","Drop or click to update image" );
				cellule.appendChild(add_btn);
			}
			$("#thumb"+s_indice).tooltip();
			$("#thumb"+s_indice).dropzone({
				url: myURL, // Affecte l'URL spécifique à chaque image
				thumbnailWidth: 100,
				thumbnailHeight: 100,
				parallelUploads: 1,
				maxFilesize: 2,
				previewTemplate: previewTemplate,
				autoQueue: true, // Démarre le téléchargement immédiatement.
				previewsContainer: "#previews", // Definit le conteneur de prévisualisation
				acceptedFiles: ".gif,.png,.jpg,.jpeg,.bmp",
				init: function() {
					var myDropzone = this;
					myDropzone.on("sending", function(file, xhr, formData) {
						document.querySelector("#total-progress").style.opacity = "1"; // Show the total progress bar when upload starts
						file.previewElement.querySelector(".start").setAttribute("disabled", "disabled"); // And disable the start button
					});
					myDropzone.on("addedfile", function(file) {
						document.querySelector("#actions .cancel").onclick = function() {
							this.removeAllFiles(true);
						};
						if (this.files[1]!=null){
							this.removeFile(this.files[0]);
						}
						file.previewElement.querySelector(".start").onclick = function() { 
							myDropzone.enqueueFile(file); 
						};
					});
					myDropzone.on("totaluploadprogress", function(progress) {
						document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
					});
					myDropzone.on("queuecomplete", function(progress) {
						document.querySelector("#total-progress").style.opacity = "1";
						myDropzone.removeAllFiles(true);
					});
					myDropzone.on("success", function(progress) {
						$("#input_conditionnement").change();
					});
				}
			});
		}
		
		var jqxhr = $.getJSON("/get_json_photos.php",{ upload_id_bmc: $("#input_conditionnement").val() }, function(json){
		})
		.done(function( json ) {
			var divphoto = document.getElementById("MyPictureDropDiv");
			var id_mbc = $("#input_conditionnement").val();
			nettoie(divphoto);
			
			//SELECT nom_fichier, id_photos_sac, type, id_marque_billes_conditionnement, index_photo FROM photos_sac WHERE photos_sac.id_marque_billes_conditionnement = '.$id_mbc.' ORDER BY id_photos_sac ASC, type DESC'
			
			var my_table = document.createElement("table");
			divphoto.appendChild(my_table);
			my_table.className ="table table-condensed table-striped table-hover";
			my_table.style.textAlign = "center";
			var my_ligne = my_table.insertRow(-1);
			var my_colonne = my_ligne.insertCell(0);
			my_colonne.innerHTML += "ID";
			my_colonne = my_ligne.insertCell(1);
			my_colonne.innerHTML += "FACE";
			my_colonne = my_ligne.insertCell(2);
			my_colonne.innerHTML += "DOS";
			i=0;
			while (i<json.length+1 ) {
				my_ligne = my_table.insertRow(-1);
				if ( i >= json.length ) {
					my_colonne = my_ligne.insertCell(0);
					my_colonne.innerHTML = 'Ajouter';
					my_colonne = my_ligne.insertCell(1);
					set_img(my_colonne, 0+"-FACE", "/upload_etiquette.php?type=FACE&index=-1&id_mbc="+id_mbc+"&update=false", "IMAGES/ETIQUETTES/NEW.JPG", 0);
					my_colonne = my_ligne.insertCell(2);
					set_img(my_colonne, 0+"-DOS", "/upload_etiquette.php?type=DOS&index=-1&id_mbc="+id_mbc+"&update=false", "IMAGES/ETIQUETTES/NEW.JPG", 0);
					i++;
					continue;
				}
				my_colonne = my_ligne.insertCell(0);
				my_colonne.innerHTML = json[i][4];
				if ( json[i][2] == 'FACE' ) {
					my_colonne = my_ligne.insertCell(1);
					set_img(my_colonne, json[i][1], "/upload_etiquette.php?type=FACE&id="+json[i][1]+"&id_mbc="+json[i][3]+"&update=true", "IMAGES/ETIQUETTES/HIDEF/"+json[i][0],json[i][1] );
					i++;
					my_colonne = my_ligne.insertCell(2);
					if ( ( i == json.length ) || ( json[i][4] != json[i-1][4] ) ) { 
						set_img(my_colonne, json[i-1][3]+"-"+json[i-1][4]+"-DOS", "/upload_etiquette.php?type=DOS&index="+json[i-1][4]+"&id_mbc="+json[i-1][3]+"&update=false", "IMAGES/ETIQUETTES/NEW.JPG", 0);
						continue;
					}
					set_img(my_colonne, json[i][1], "/upload_etiquette.php?type=DOS&id="+json[i][1]+"&id_mbc="+json[i][3]+"&update=true", "IMAGES/ETIQUETTES/HIDEF/"+json[i][0], json[i][1]);
					i++;
					continue;
				} else {
					my_colonne = my_ligne.insertCell(1);
					set_img(my_colonne, json[i][3]+"-"+json[i][4]+"-FACE", "/upload_etiquette.php?type=FACE&index="+json[i][4]+"&id_mbc="+json[i][3]+"&update=false", "IMAGES/ETIQUETTES/NEW.JPG", 0);
					my_colonne = my_ligne.insertCell(2);
					set_img(my_colonne, json[i][1], "/upload_etiquette.php?type=DOS&id="+json[i][1]+"&id_mbc="+json[i][3]+"&update=true", "IMAGES/ETIQUETTES/HIDEF/"+json[i][0], json[i][1]);
					i++;
					continue;
				}
			}
			$("#poubelle").removeClass("hidden");
			$("#MyPictureDropDiv").removeClass("hidden");
		})

		.fail(function( jqxhr, textStatus, error ) {
			var err = textStatus + ", " + error;
			swal({ title: "Erreur lors de l'accès aux photos", text: err, imageUrl: "IMAGES/MAIN/LODEF/14.jpg" });
		})
 	})

	$("#input_conditionnement").val($("#bmc").val()).change();

});

$(function (){
    var i, $this;
	
    $('#poubelle').on({
        dragenter: function(e) {
            e.preventDefault();
        },
        dragleave: function() {
        },
        dragover: function(e) {
            e.preventDefault();
        },
        drop: function(e) {
			console.log( 'drop : '+data );
            var data = e.dataTransfer.getData('text');
			var debut = data.indexOf('id=',0)+3;
			var fin = data.indexOf('&',debut);
			id_photo_to_delete = data.substr(debut, fin-debut);
			var jqxhr = $.getJSON("/delete_json_etiquette.php",{id: id_photo_to_delete}, function(json){
			})
			.done(function( json ) {
				console.log( "delete_json_etiquette.php" );
				$("#input_conditionnement").change();
			})
			.fail(function( jqxhr, textStatus, error ) {
				var err = textStatus + ", " + error;
				swal({ title: "Erreur lors de la suppression de l'image", text: err, imageUrl: encodeURI(data) });
			})
            e.preventDefault();
        }
    });
});

</script>

</body>
</html>
