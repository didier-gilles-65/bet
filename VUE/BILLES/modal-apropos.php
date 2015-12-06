<div class="modal" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="bet-sub-nav blog-title" style="padding:10px; border-top-left-radius:6px; border-top-right-radius:6px">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style>&times;</button>
				<h3 class="modal-font-title"><strong><?php echo $lib_modal_10;?></strong></h3>
			</div>
			<div class="modal-body" style="background-color: #FFFBF4"><?php echo $lib_modal_20;?></div>
			<div class="modal-footer" style="margin-top:0px" >
				<a href="#" class="btn btn-warning" data-dismiss="modal"><?php echo $lib_modal_30;?></a>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<div  class="modal" id="modal_login" style="padding: 15px; padding-bottom: 0px;">
	<div class="modal-dialog" style="width:400px">
		<div class="modal-content">
			<div class="bet-sub-nav blog-title" style="padding:10px; border-top-left-radius:6px; border-top-right-radius:6px">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-font-title"><?php echo $lib_login_90;?></h3>
			</div>
			<br/>
			<form id="menu_login_form" name="menu_login_form" method="post" action="/UTILS/autorisation.php?page=<?php echo $_SERVER['REQUEST_URI']; ?>">
				<fieldset>
					<div class="control-group" align="center">
						<label class="control-label" for="connect_login"><?php echo $lib_login_30; ?></label>
						<div class="controls">
							<input type="text" style="width:200px" class="form-control" name="connect_login" id="connect_login" placeholder="<?php echo $lib_login_40; ?>">
							<label for="connect_login" class="help-block"></label>
						</div>
					</div>
			<br/>
					<div class="control-group" align="center">
						<label class="control-label" for="connect_password"><?php echo $lib_login_60; ?></label>
						<div class="controls">
							<input type="password" style="width:200px" class="form-control" name="connect_password" id="connect_password" placeholder="<?php echo $lib_login_70; ?>">
							<label for="connect_password" class="help-block"></label>
						</div>
					</div>
			<br/>
					<div class="control-group" align="center">
						<label class="checkbox"  style="width:200px" for="login_persistent"><?php echo $lib_login_85; ?>
							<input class="checkbox_inline" type="checkbox" id="login_persistent" name="login_persistent" value="true">
						</label>
					</div>
					<br/>
					<div class="control-group" align="center" >
						<button class="btn btn-warning " type="submit"><?php echo $lib_login_90; ?></button>
					</div>
					<br/>
					<div class="control-group" align="center">
						<label class="control-label" style="font-size:100%;"><a href="reset_password.php"><?php echo $lib_login_100; ?></a></label>
					<div class="control-group" align="center">
						<label class="control-label" style="font-size:100%;"><a href="register.php"><?php echo $lib_nav_270; ?></a></label>
					</div>
			<br/>
				</fieldset>
			</form>
		</div><!-- /.modal-content -->
	</div>
</div>
