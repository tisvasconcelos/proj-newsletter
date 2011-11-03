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
    			<?if(!$template){?>
    			<form class="frmTemplate" action="<?=site_url('template/insert')?>" method="post" enctype="multipart/form-data">
    			<?}else{?>
				<form class="frmTemplate" action="<?=site_url('template/update')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="so_id" value="<?=$template->so_id?>" />
				<?}?>
    				<h2><?=$this->lang->line('interface_template')?></h2>
    				<fieldset>
    					<p>
    						<label title="<?=$this->lang->line('interface_name')?>"><?=$this->lang->line('interface_name')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_name')?>" name="name" value="<?if($template) echo $template->tpd_name?>" />
    					</p>
						<?if(!$template){?>
    					<p>
    						<label title="<?=$this->lang->line('interface_file')?>"><?=$this->lang->line('interface_file')?>:</label>
    						<input type="file" title="<?=$this->lang->line('interface_name')?>" class="file" name="userfile" size="28" value="" />
    					</p>
						<?}?>
						<br clear="all" />
						<?if($template){?>
						<textarea name="html" id="html"><?if($template) echo $template->tpd_html?></textarea>
						<?}?>		
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
    		interface.template.validate('form.frmTemplate');
			<?if($template){?>
			CKEDITOR.replace('html',{
				//filebrowserBrowseUrl : '<?=call('interface/javascript/ckfinder/ckfinder.html')?>'
				/*imagesPath : CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'templates' ) + 'templates/images/' ),
				templates :
					[
						{
							title: 'My Template 1',
							image: 'template1.gif',
							description: 'Description of my template 1.',
							html:
								'<h2>Template 1</h2>' +
								'<p><img src="/logo.png" style="float:left" />Type the text here.</p>'
						},
						{
							title: 'My Template 2',
							html:
								'<h3>Template 2</h3>' +
								'<p>Type the text here.</p>'
						}
					]*/
    		});
			<?}?>
    	</script>
    </body>
</html>