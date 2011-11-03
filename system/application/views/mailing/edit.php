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
    	<?include($this->config->config['path'].'includes/header.php');?>
    	<div id="main">
    		<div class="center">
    			<form class="frmMailing" action="<?=site_url('mailing/insert')?>" method="post" enctype="multipart/form-data">
    				<h2><?=$this->lang->line('interface_mailing')?></h2>
    				<fieldset>
    					<p>
    						<label title="<?=$this->lang->line('interface_name')?>"><?=$this->lang->line('interface_name')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_name')?>" name="name" value="" />
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_file')?>"><?=$this->lang->line('interface_file')?>:</label>
    						<input type="file" title="<?=$this->lang->line('interface_name')?>" class="file" name="userfile" size="22" value="" />
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
    		interface.mailing.validate('form.frmMailing');
    	</script>
    </body>
</html>