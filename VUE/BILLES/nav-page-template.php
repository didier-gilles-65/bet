				<div class="row pagination-nav">
						<nav>
					<div class="col-xs-12 col-sm-12 col-md-4" align="center" >
							<ul class="pagination pagination-sm">
<?php if ($from == 0) { ?>
								<li class="disabled"><a href="#"><i class="glyphicon glyphicon-fast-backward"></i></a></li>
								<li class="disabled"><a href="#"><i class="glyphicon glyphicon-step-backward"></i></a></li>
<?php } else { ?>
								<li><a href="liste_billes.php?from=0"><i class="glyphicon glyphicon-fast-backward"></i></a></li>
<?php 	if ($from < $pagination) { ?>
								<li><a href="liste_billes.php?from=0"><i class="glyphicon glyphicon-step-backward"></i></a></li>
<?php 	} else { ?>
								<li><a href="liste_billes.php?from=<?php echo $from - $pagination; ?>"><i class="glyphicon glyphicon-step-backward"></i></a></li>
<?php 	} ?>
<?php } ?>
<?php
		$page_courante = $from/$pagination+1;
		$page_max = 1 + ($nb_billes - ($nb_billes % $pagination)) / $pagination;
		if ( $page_courante <= 4 ) { $page_index = 1; } 
		else if ( $page_courante >= $page_max - 1 )  { $page_index = $page_max - 4; } 
		else { $page_index = ( $page_courante - 1 - ( $page_courante - 2) % 3); }
 		$i = $page_index-1;
		do {
			$i++;
			if ($i < $page_max+1) { echo '<li'.( $from == ($i-1)*$pagination?' class="active" ':'' ).'><a href="liste_billes.php?from='.($i-1)*$pagination.'">'.(($i == $page_index) && ($i > 1)?'...'.$i:$i).(($i == $page_index+4) && ($i < $page_max)?'...':'').'</a></li>'; }
		} while ($i < $page_index+4)
 ?>
<?php 	if ( $from == $nb_billes - ($nb_billes % $pagination))  { ?>
								<li class="disabled"><a href="#"><i class="glyphicon glyphicon-step-forward"></i></a></li>
<?php } else { ?>
								<li><a href="liste_billes.php?from=<?php echo $from + $pagination; ?>"><i class="glyphicon glyphicon-step-forward"></i></a></li>
<?php } ?>
<?php 	if ( $from == $nb_billes - ($nb_billes % $pagination))  { ?>
								<li class="disabled"><a href="#"><i class="glyphicon glyphicon-fast-forward"></i></a></li>
<?php } else { ?>
								<li><a href="liste_billes.php?from=<?php echo $nb_billes - ($nb_billes % $pagination); ?>"><i class="glyphicon glyphicon-fast-forward"></i></a></li>
<?php } ?>
							</ul>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4" align="center" >
							<ul class="pagination pagination-sm">
								<li<?php if ( isset($pagination) && ($pagination==10 ) ) { echo ' class="active" ';} ?>><a href="UTILS/change_pagination.php?page=liste_billes&pagination=10"><i class="glyphicon glyphicon-resize-vertical">&nbsp;</i>/10</a></li>
								<li<?php if ( isset($pagination) && ($pagination==50 ) ) { echo ' class="active" ';} ?>><a href="UTILS/change_pagination.php?page=liste_billes&pagination=50"><i class="glyphicon glyphicon-resize-vertical">&nbsp;</i>/50</a></li>
								<li<?php if ( isset($pagination) && ($pagination!=10) && ($pagination!=50)) { echo ' class="active" ';} ?>><a href="UTILS/change_pagination.php?page=liste_billes&pagination=0"><i class="glyphicon glyphicon-resize-vertical">&nbsp;</i><?php echo $lib_index_411; ?></a></li>
							</ul>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-4" align="center" >
							<ul class="pagination pagination-sm">
								<li<?php if ( isset($style_liste) && ($style_liste=='liste longue' ) ) { echo ' class="active" ';} ?>><a href="UTILS/change_style_liste.php?page=liste_billes&style_liste=liste longue"><i class="glyphicon glyphicon-th-list">&nbsp;</i> <?php echo $lib_index_411; ?></a></li>
								<li<?php if ( isset($style_liste) && ($style_liste=='noms' ) ) { echo ' class="active" ';} ?>><a href="UTILS/change_style_liste.php?page=liste_billes&style_liste=noms"><i class="glyphicon glyphicon-th">&nbsp;</i><?php echo $lib_index_412; ?></a></li>
								<li<?php if ( isset($style_liste) && ($style_liste=='images' ) ) { echo ' class="active" ';} ?>><a href="UTILS/change_style_liste.php?page=liste_billes&style_liste=images"><i class="glyphicon glyphicon-th-large">&nbsp;</i><?php echo $lib_index_413; ?></a></li>
							</ul>
					</div>
						</nav>
				</div>

