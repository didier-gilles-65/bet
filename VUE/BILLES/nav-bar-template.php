<?php include('MODELE/BLOGS/get_avatar.php'); ?>
<header class="navbar navbar-inverse navbar-static-top" role="banner" style="margin-bottom:0px">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" rel="home" href="/"><img src="IMAGES/LOGO.PNG" style="height:18px;"/></a>
		</div>
		<nav class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
<!-- HOME -->
				<li<?php if ($pagecourante == 'index') { echo ' class="active"';} ?>>
					<a href="index.php" rel="tooltip" data-placement="bottom" title="<?php echo $lib_nav_10;?>"><i class="glyphicon glyphicon-home"></i> <?php echo $lib_nav_20;?></a>
				</li>
<!-- LISTES -->
				<li class="dropdown">
					<a href="#" id="liste" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-list-alt"></i> <?php echo $lib_nav_25;?> <b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="listes">
						<li><a href="liste_billes.php" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_14;?>"><i class="glyphicon glyphicon-refresh"></i> <?php echo $lib_nav_27;?></a></li>
						<li><a href="liste_billes.php?reset=true" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_15;?>"><i class="glyphicon glyphicon-book"></i> <?php echo $lib_nav_28;?></a></li>
						<li><a href="critere_bille.php" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_17;?>"><i class="glyphicon glyphicon-wrench"></i> <?php echo $lib_nav_29;?></a></li>
						<li class="divider"></li>
						<li class="dropdown-submenu"> <a tabindex="-1" href="#"><i class="glyphicon glyphicon-filter"></i> <?php echo $lib_nav_50; ?></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="rechercheparcritere">
<?php foreach ($MENUMARQUES as $MENUMARQUE)  { ?>				
							<li><a tabindex="-1" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_60;?> <?php echo $MENUMARQUE['MARQUE'];?>" href="filtragemarque.php?marque=<?php echo $MENUMARQUE['MARQUE'];?>"><i class="glyphicon glyphicon-comment"></i> <?php echo $MENUMARQUE['MARQUE'];?></a></li>
<?php }?>				
						</ul>
						<li class="divider"></li>
						<li><a href="detail.php" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_30;?>"><i class="glyphicon glyphicon-zoom-in"></i> <?php echo $lib_nav_40;?></a></li>
<?php if ((isset($_SESSION['connect'])) && ($_SESSION['connect'] == 1)) { ?>
						<li class="divider"></li>
						<li class="disabled"><a href="inventory.php" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_300;?>"><i class="glyphicon glyphicon-pencil"></i> <?php echo $lib_nav_45;?></a></li>
<?php if ((isset($_SESSION['profile'])) && ($_SESSION['profile'] == 'ADMIN')) { ?>
						<li><a href="liste_scans.php" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_310;?>"><i class="glyphicon glyphicon-barcode"></i> <?php echo $lib_nav_320;?></a></li>
<?php } ?>
<?php } ?>
					</ul>
				</li>
<!-- BLOGS -->
				<li<?php if ($pagecourante == 'blog') { echo ' class="active"';} ?>>
					<a href="blogs.php" rel="tooltip" data-placement="bottom" title="<?php echo $lib_nav_16;?>"><i class="glyphicon glyphicon-comment"></i> <?php echo $lib_nav_26;?></a>
				</li>
<!-- INFORMATIONS -->
				<li class="dropdown">
					<a href="#" id="menu_contact" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-question-sign"></i> <?php echo $lib_nav_80;?> <b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="menu_contact">
						<li><a tabindex="-1" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_90;?>" href="liens.php"><i class="glyphicon glyphicon-globe"></i> <?php echo $lib_nav_100;?></a></li>
						<li><a tabindex="-1" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_110;?>" href="contact.php"><i class="glyphicon glyphicon-envelope"></i> <?php echo $lib_nav_120;?></a></li>
						<li class="divider"></li>
						<li><a data-toggle="modal" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_130;?>" href="#myModal"><i class="glyphicon glyphicon-info-sign"></i> <?php echo $lib_nav_140;?></a></li>
					</ul>
				</li>
<!-- LANGUES -->
				<li class="dropdown">
					<a href="#" id="menulangage" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-flag"></i> <?php echo $lib_nav_150;?> <b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="menulangage">
						<li><a tabindex="-1" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_160;?>" href="set_langue.php?lang=fr&page=<?php echo $_SERVER['REQUEST_URI'];?>"><img src="IMAGES/france.png" height=23px/> <?php echo $lib_nav_170;?></a></li>
						<li><a tabindex="-1" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_180;?>" href="set_langue.php?lang=en&page=<?php echo $_SERVER['REQUEST_URI'];?>"><img src="IMAGES/United Kingdom(Great Britain).png" height=23px/> <?php echo $lib_nav_190;?></a></li>
					</ul>
				</li>
<!-- UTILISATEUR -->
<?php if (!(isset($_SESSION['connect'])) || ($_SESSION['connect'] != 1)) { ?>
				<li class="dropdown" >
					<a class="dropdown-toggle" href="#" data-toggle="dropdown" ><i class="glyphicon glyphicon-user"></i> <?php echo $lib_nav_245; ?> <strong class="caret"></strong></a>
					<ul class="dropdown-menu">
						<li><a data-toggle="modal" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_250;?>" href="#modal_login"><i class="glyphicon glyphicon-log-in"></i> <?php echo $lib_nav_250;?></a></li>
						<li><a tabindex="-1" rel="tooltip" data-placement="bottom" title="<?php echo $lib_nav_260; ?>" href="register.php"><i class="glyphicon glyphicon-refresh"></i> <?php echo $lib_nav_270; ?></a></li>
					</ul>
                </li>
<?php } else { ?>				
				<li class="dropdown" >
					<a class="dropdown-toggle" href="#" data-toggle="dropdown" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_240; ?>"><i class="glyphicon glyphicon-user"></i> <?php echo $lib_nav_245; ?> <strong class="caret"></strong></a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_210; ?>" href="unsign.php?&page=<?php echo $_SERVER['REQUEST_URI']; ?>"><i class="glyphicon glyphicon-log-out"></i> <?php echo $lib_nav_220; ?></a></li>
						<li><a tabindex="-1" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_280; ?>" href="change_user.php"><i class="glyphicon glyphicon-refresh"></i> <?php echo $lib_nav_290; ?></a></li>
					</ul>
                </li>
<?php } ?>
			</ul>
		</nav><!--/.nav-collapse -->
	</div>
	</div>

</header>

<?php if ( !stripos($_SERVER['REQUEST_URI'],"index.php") && stripos($_SERVER['REQUEST_URI'],"php") ) { ?> 
<header class="bet-sub-nav" >
	<div class="container hidden-print" >
		<div class="col-sm-5 hidden-xs breadCrumb module" id="breadcrumb" style="padding-top:10px; padding-bottom:10px">
			<?php if ( isset($breadcrumb) )  { echo $breadcrumb; } ?>
		</div>
		<div class="col-xs-6 col-sm-4" align="right" style="padding-top:10px; padding-bottom:10px">
<?php if ((isset($_SESSION['connect'])) && (isset($_SESSION['email'])) && (isset($_SESSION['gravatar_flag'])) && ($_SESSION['connect'] == 1)) { ?>
			<span class="badge" style="padding:0px"><span class="hidden-xs" style="margin-left:7px"> Connecté </span><img class="img-circle" style="width:25px;" src="<?php echo get_avatar_link($_SESSION['login'], $_SESSION['email'], $_SESSION['gravatar_flag']);  ?>" alt="..." ></span>
			
			<span style="pull-right; height:25px"><a class="badge" style="height:23px" tabindex="-1" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_210; ?>" href="unsign.php?&page=<?php echo $_SERVER['REQUEST_URI']; ?>"><i class="glyphicon glyphicon-log-out"></i></a>
<?php } else {?>
			<span style="pull-right"><a class="btn btn-xs btn-warning" data-toggle="modal" rel="tooltip" data-placement="right" title="<?php echo $lib_nav_250;?>" href="#modal_login"><i class="glyphicon glyphicon-log-in"></i> <?php echo $lib_nav_250;?></a>
<?php }?>
		</span></div>
		<div class="col-xs-6 col-sm-3" style="padding-top:9px; padding-bottom:11px; padding-right:0px ">
			<form method="post" action="recherche.php">
				<div class="input-group" <?php if ( !stripos($_SERVER['REQUEST_URI'],"index.php") ) { ?>align="right"<?php }?>>
					<input class="search-query form-control" style="display:inline; width:100%; height:25px" placeholder="<?php echo $lib_nav_200;?>" type="text" id="critere" name="critere">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-sm btn-warning" style="height:25px">
							<span class="glyphicon glyphicon-search">
							</span>
						</button>
					</span>
				</div>
			</form>
		</div>
	</div><!-- status bar -->
</header>
<?php }?>

