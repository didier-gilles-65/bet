<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_links_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>

<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li>'.$crumb_liens.'</li></ul>';
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
?>
<main>
<div class="container" >
	<div class="row page-head"> <!-- Barre de titre locale à la page -->
		<div class="col-xs-12 col-md-4 vcenter" style="font-size:100%;" align="center">
			<?php echo '<strong>'.$lib_links_10.'</strong>'; ?>
		</div>
    </div>
	<div class="row" align="center">

<?php
foreach($liens as $lien)
{
?>
		<div class="page-list-lining"></div>
		<div class="row" align="center">
			<div class="col-md-2" style="margin-top: 10px;"><strong><?php echo $lien['NOM']; ?></strong></div>
			<div class="col-md-3" style="margin-top: 10px;" ><a href="<?php echo $lien['URL']; ?>"><span class="label label-warning" style="font-size:100%"><?php echo $lien['URL']; ?></span></a></div>
			<div class="col-md-6" style="margin-top: 5px;">
				<p><?php echo $lien['DESCRIPTION']; ?></p>
				<strong><?php echo $lien['ADRESSE_COMPLETE']; ?></strong>
			</div>

			<div class="col-md-1" style="margin-top: 5px;">
<?php
if ($lien['ADRESSE_COMPLETE'] != '')
{
?>
				<a class="btn btn-warning btn-md Location" rel="tooltip" data-placement="right" data-adresse="<?php echo $lien['ADRESSE_COMPLETE']; ?>" title="<?php echo $lib_links_50;?>" href="#"><i class="glyphicon glyphicon-map-marker"></i></a>
<?php
}
?>
			</div>
		</div>
<?php
}
?>
	</div>
	<div class="row" id="MyMapModal">
		<div class="col-md-6 col-md-offset-3" style="margin-top: 5px;">
			<div id="map"></div>
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
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="dist/js/gmaps-master/gmaps.js"></script>
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	<script>
		$(document).ready(function(){
	         $('#breadcrumb').jBreadCrumb();
		});
	</script>
  <script type="text/javascript">
    var map;
    $(document).ready(function(){
//      prettyPrint();
      map = new GMaps({
        div: '#map',
        lat: -90,
        lng: -0
      });
    });
	$(document).on('click', '.Location', function(e) {
	//$("tofade").fadeToggle();
	var myModal = document.getElementById("MyMapModal");
	$("#MyMapModal").toggle();
	var myaddress = $(this).data('adresse');
		e.preventDefault();
        GMaps.geocode({
          address: $(this).data('adresse'),
          callback: function(results, status){
            if(status=='OK'){
              var latlng = results[0].geometry.location;
              map.setCenter(latlng.lat(), latlng.lng());
              map.addMarker({
                lat: latlng.lat(),
                lng: latlng.lng()
              });
            }
          }
        });
	});
  </script>
</body>
</html>
