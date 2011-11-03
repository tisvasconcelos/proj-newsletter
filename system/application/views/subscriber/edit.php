<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-us">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Expires" content="Fri, 19 Nov 2010 23:59:59 GMT">
        <title>Newsletter</title>
		<link rel="stylesheet" type="text/css" href="<?=call('interface/style/login.css');?>">
		<script type="text/javascript" src="<?=call('interface/javascript/jquery/jquery-1.4.2.min.js')?>"></script>
    </head>
    <body>
    	<?include($this->config->config['path'].'includes/data.php');?>
    	<div id="main">
    		<div class="center" id="login">
    			<?if(isset($subscriber)){?>
				<form name="frmLogin" class="frmLogin" action="<?=site_url('subscriber/update')?>" method="post">
					<input type="hidden" name="encrypted" value="<?=$subscriber->scd_encrypted?>" />
				<?}else{?>
				<form name="frmLogin" class="frmLogin" action="<?=site_url('subscriber/insert')?>" method="post">
				<?}?>
					<fieldset>
						<?if(isset($message)){?>
						<p class="message"><?=$message?></p>
						<?}?>
						<p>
							<label for="<?=$this->lang->line('interface_name')?>"><?=$this->lang->line('interface_name')?>:</label>
							<input type="text" id="<?=$this->lang->line('interface_name')?>" name="name" value="<?=(isset($subscriber))?$subscriber->scd_name:"";?>" />
						</p>
						<p>
							<label for="<?=$this->lang->line('interface_email')?>"><?=$this->lang->line('interface_email')?>:</label>
							<input type="text" id="<?=$this->lang->line('interface_email')?>" name="email" value="<?=(isset($subscriber))?$subscriber->scd_email:"";?>" />
						</p>
						<p>
							<button type="submit" title="Salvar">Salvar</button>
						</p>
					</fieldset>
				</form>
	    	</div>
    	</div>
    	<script type="text/javascript" src="<?=call('interface/javascript/interface.js')?>"></script>
    	<script type="text/javascript">
    		interface.login.validate('#login form.frmLogin');
    	</script>
    </body>
</html>