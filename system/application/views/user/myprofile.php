<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-us">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Expires" content="Fri, 19 Nov 2010 23:59:59 GMT">
        <title>Newsletter</title>
		<link rel="stylesheet" type="text/css" href="<?=call('interface/style/style.css');?>">
		<script type="text/javascript" src="<?=call('interface/javascript/jquery/jquery-1.4.2.min.js')?>"></script>
    </head>
    <body>
    	<?include($this->config->config['path'].'includes/data.php');?>
    	<?include('system/application/views/includes/header.php');?>
    	<div id="main">
    		<div class="center">
    			<form class="frmMyProfile" action="<?=site_url('myprofile/update')?>" method="post">
    				<input type="hidden" name="so_id" value="<?=$user->so_id?>" />
    				<h2><?=$this->lang->line('interface_myprofile')?></h2>
    				<fieldset>
    					<p>
    						<label title="<?=$this->lang->line('interface_name')?>"><?=$this->lang->line('interface_name')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_name')?>" name="name" value="<?=$user->usd_name?>" />
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_lastname')?>"><?=$this->lang->line('interface_lastname')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_lastname')?>" name="lastname" value="<?=$user->usd_lastname?>" />
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_username')?>"><?=$this->lang->line('interface_username')?>:</label>
    						<input type="text" maxlength="15" title="<?=$this->lang->line('interface_username')?>" name="username" value="<?=$user->usd_username?>" />
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_password')?>"><?=$this->lang->line('interface_password')?>:</label>
    						<input type="password" maxlength="15" title="<?=$this->lang->line('interface_password')?>" name="password" value="" />
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_email')?>"><?=$this->lang->line('interface_email')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_email')?>" name="email" value="<?=$user->usd_email?>" />
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
    	<?include('system/application/views/includes/footer.php');?>
    	<script type="text/javascript" src="<?=call('interface/javascript/interface.js')?>"></script>
    	<script type="text/javascript">
    		interface.myprofile.validate('form.frmMyProfile');
    	</script>
    </body>
</html>