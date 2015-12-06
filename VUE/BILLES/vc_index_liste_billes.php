	<div class="container">
		<div class="row page-head">
			<div class="col-xs-12 col-md-4 vcenter" style="font-size:100%;" align="center">
				<?php if ( isset($_SESSION['LISTE_CONTEXT'])) { echo $lib_index_20.'<strong>'.$_SESSION['LISTE_CONTEXT'].'</strong>'; } else { echo '<strong>'.$lib_index_30.'</strong>'; } ?>
			</div><!--
			--><div class="col-xs-12 col-md-4 col-md-offset-4 vcenter" align="center">
				<?php if ((isset($pagecourante)) && ($pagecourante == 'liste_billes')) { echo $lib_index_10.'<span class="badge badge-error" style="margin-right:10px; background-color:blue">'.$nb_billes.'</span>';} ?>
				<?php echo $lib_index_11; ?><span class="badge badge-error" style="background-color:brown"><?php echo $total_billes; ?></span>
			</div>
		</div>
<!-- ligne de pagination -->
			<div class="hidden-print" align="center">
				<?php if ( !isset($critere) ) { include('VUE/BILLES/nav-page-template.php'); } ?>
			</div>
<?php if ( isset($style_liste) && ($style_liste=='liste longue' ) ) { ?>
<!-- Entete de la table -->
			<div class="row hidden-print row-liste-billes-head" style="text-align:center">
				<div class="col-sm-2"><?php echo $lib_index_60; ?></div>
				<div class="col-sm-2"><?php echo $lib_index_70; ?></div>
				<div class="col-sm-8"><?php echo $lib_index_80; ?></div>
			</div>
			<div class="row visible-print" style="text-align:center">
				<div class="col-xs-2"><?php echo $lib_index_60; ?></div>
				<div class="col-xs-3"><?php echo $lib_index_70; ?></div>
				<div class="col-xs-7"><?php echo $lib_index_80; ?></div>
			</div>
	<!-- Table des billes -->
<?php foreach($billes as $bille) { ?>
			<div class="row hidden-print row-liste-billes" style="text-align:center">
				<div class="page-list-lining"></div>
				<div class="col-sm-2"><strong><a href="detail.php?id=<?php echo $bille['ID_BILLES']; ?>" rel="tooltip" data-original-title="<?php echo $lib_index_110; ?> <?php echo $bille['NOM']; ?>"><em><?php echo $bille['NOM']; ?></em></a></strong></div>
				<div class="col-sm-2"><a class="image-popup-fit-width" href="IMAGES/MAIN/LODEF/<?php if (file_exists('IMAGES/MAIN/LODEF/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" rel="tooltip" data-original-title="<?php echo $lib_index_120; ?> <?php echo $bille['NOM']; ?>" >
					<img src="IMAGES/MAIN/THUMBNAIL/<?php if (file_exists('IMAGES/MAIN/THUMBNAIL/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" alt='<?php echo $bille['NOM']; ?>' class="img-rounded"/>
					</a>
				</div>
				<div class="col-sm-8"><em><?php echo $bille['DESCRIPTION']; ?></em></div>
			</div>
			<div class="row visible-print" style="text-align:center">
				<div class="page-list-lining"></div>
				<div class="col-xs-2"><a href="detail.php?id=<?php echo $bille['ID_BILLES']; ?>" rel="tooltip" data-original-title="<?php echo $lib_index_110; ?> <?php echo $bille['NOM']; ?>"><em><?php echo $bille['NOM']; ?></em></a></div>
				<div class="col-xs-3"><a class="image-popup-fit-width" href="IMAGES/MAIN/LODEF/<?php if (file_exists('IMAGES/MAIN/LODEF/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" rel="tooltip" data-original-title="<?php echo $lib_index_120; ?> <?php echo $bille['NOM']; ?>" >
					<img src="IMAGES/MAIN/THUMBNAIL/<?php if (file_exists('IMAGES/MAIN/THUMBNAIL/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" alt='<?php echo $bille['NOM']; ?>' class="img-rounded"/>
					</a>
				</div>
				<div class="col-xs-7"><em><?php echo $bille['DESCRIPTION']; ?></em></div>
			</div>
<?php
}
}
else
{ $i = 0;
?>

	<!-- Table courte des billes -->
			<div class="row">
<?php foreach($billes as $bille) { ?>
			<?php $i += 1; ?>
	<?php if ( isset($style_liste) && ($style_liste=='noms' ) ) { if ($i % 4 == 1) {echo '</div><div class="row"><div class="page-list-lining"></div>';}?>
			<div class="col-xs-3"><a href="detail.php?id=<?php echo $bille['ID_BILLES']; ?>" rel="tooltip" data-original-title="<?php echo $lib_index_110; ?> <?php echo $bille['NOM']; ?>"><em><?php echo $bille['NOM']; ?></em></a></div>
	<?php } else { if ($i % 12 == 1) {echo '</div><div class="row"><div class="page-list-lining"></div>';}?>
			<div class="col-xs-1" align="center" style="padding: 0px"><a href="detail.php?id=<?php echo $bille['ID_BILLES']; ?>" rel="tooltip" data-original-title="<?php echo $lib_index_120; ?> <?php echo $bille['NOM']; ?>" >
				<img src="IMAGES/MAIN/THUMBNAIL/<?php echo $bille['ID_BILLES']; ?>.jpg" alt='<?php echo $bille['NOM']; ?>' class="img-rounded"/>
				</a>
			</div>
	<?php } ?>
<?php } ?>
		</div>
<?php
}
?>
	</div>