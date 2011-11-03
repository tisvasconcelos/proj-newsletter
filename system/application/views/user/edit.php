<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-us">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Expires" content="Fri, 19 Nov 2010 23:59:59 GMT">
        <title>Newsletter</title>
		<link rel="stylesheet" type="text/css" href="<?=call('interface/style/style.css');?>">
		<script type="text/javascript" src="<?=call('interface/javascript/jquery/jquery-1.4.2.min.js')?>"></script>
		<script type="text/javascript" src="<?=call('interface/javascript/ckeditor/ckeditor.js')?>"></script>
    </head>
    <body>
    	<?include($this->config->config['path'].'includes/data.php');?>
    	<?include($this->config->config['path'].'includes/header.php');?>
    	<div id="main">
    		<div class="center">
    			<?if(!$user){?>
    			<form class="frmMyProfile" action="<?=site_url('user/insert')?>" method="post" enctype="multipart/form-data">
    			<?}else{?>
				<form class="frmMyProfile" action="<?=site_url('user/update')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="so_id" value="<?=$user->so_id?>" />
				<?}?>
    				<h2><?=$this->lang->line('interface_users')?></h2>
    				<fieldset>
    					<p>
    						<label title="<?=$this->lang->line('interface_name')?>"><?=$this->lang->line('interface_name')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_name')?>" name="name" value="<?if($user) echo $user->usd_name?>" />
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_lastname')?>"><?=$this->lang->line('interface_lastname')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_lastname')?>" name="lastname" value="<?if($user) echo $user->usd_lastname?>" />
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_username')?>"><?=$this->lang->line('interface_username')?>:</label>
    						<input type="text" maxlength="15" title="<?=$this->lang->line('interface_username')?>" name="username" value="<?if($user) echo $user->usd_username?>" />
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_password')?>"><?=$this->lang->line('interface_password')?>:</label>
    						<input type="password" maxlength="15" title="<?=$this->lang->line('interface_password')?>" name="password" value="" />
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_email')?>"><?=$this->lang->line('interface_email')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_email')?>" name="email" value="<?if($user) echo $user->usd_email?>" />
    					</p>
						<p>
							<label title="<?=$this->lang->line('interface_level')?>"><?=$this->lang->line('interface_level')?>:</label>
							<?
							$options = array(
								'' => "",
								'1' => $this->lang->line('interface_administrator'),
								'2' => $this->lang->line('interface_publisher')
							);
							if($user)
								echo form_dropdown('level', $options, $user->usd_level);
							else
								echo form_dropdown('level', $options);
							?>
						</p>
    					<br clear="all" />
    					<p>&nbsp;</p>
    					<p>
    						<button type="submit" title="<?=$this->lang->line('interface_save')?>" value="<?=$this->lang->line('interface_save')?>"><?=$this->lang->line('interface_save')?></button>
    					</p>
    				</fieldset>
    			</form>
	    	</div>
    	</div>
    	<script type="text/javascript" src="<?=call('interface/javascript/interface.js')?>"></script>
    	<script type="text/javascript">
    		interface.user.validate('form.frmMyProfile');
    	</script>
    </body>
</html>