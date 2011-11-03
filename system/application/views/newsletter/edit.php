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
    			<?if(!$newsletter){?>
    			<form class="frmNewsletter" action="<?=site_url('newsletter/insert')?>" method="post" enctype="multipart/form-data">
    			<?}else{?>
				<form class="frmNewsletter" action="<?=site_url('newsletter/update')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="so_id" value="<?=$newsletter->so_id?>" />
				<?}?>
    				<h2><?=$this->lang->line('interface_newsletter')?></h2>
    				<fieldset>
    					<p>
    						<label title="<?=$this->lang->line('interface_name')?>"><?=$this->lang->line('interface_name')?>/<?=$this->lang->line('interface_subject')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_name')?>" name="name" value="<?if($newsletter) echo $newsletter->nld_name?>" />
    					</p>
    					<p>
    						<label title="code">Código:</label>
							<?php
							if(!$newsletter || empty($newsletter->nld_code)){
								$options = array(
									'' => 'Selecione',
									'CA' => 'Cobra Automotiva',
									'CAP' => 'Cobra Automotiva Promoção',
									'CR' => 'Cobra Rolamento',
									'CRP' => 'Cobra Rolamento Promoção',
									'P' => 'Promoção',
									'A' => 'Aniversariantes',
									'IF' => 'Informações Técnicas',
									'L' => 'Lançamento',
									'CV' => 'Campanha de Vendas',
									'LP' => 'Lista de Preços'
								);
								echo form_dropdown('code', $options);
							}else{
								echo $newsletter->nld_code;
							}
							?>
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_sender')?>"><?=$this->lang->line('interface_sender')?>/<?=$this->lang->line('interface_name')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_sender')?>" name="sender" value="<?if($newsletter) echo $newsletter->nld_sender?>" />
    					</p>
    					<p>
    						<label title="<?=$this->lang->line('interface_email')?>"><?=$this->lang->line('interface_sender')?>/<?=$this->lang->line('interface_email')?>:</label>
    						<input type="text" maxlength="45" title="<?=$this->lang->line('interface_email')?>" name="email" value="<?if($newsletter) echo $newsletter->nld_email?>" />
    					</p>
    					<p>
							<label title="<?=$this->lang->line('interface_mailing')?>"><?=$this->lang->line('interface_mailing')?>:</label>
							<?php
							$options = array(
								'' => 'Selecione' 
							);
							foreach($mailings as $m){
								$options[$m->so_id] = $m->mld_name;
							}
							if(!$newsletter)
								echo form_dropdown('mailing', $options);
							else
								echo form_dropdown('mailing', $options, $newsletter->mld_id);
							?>
    					</p>
    					<p>
							<label title="<?=$this->lang->line('interface_template')?>"><?=$this->lang->line('interface_template')?>:</label>
							<?php 
							$options = array(
								'' => 'Selecione'
							);
							foreach($templates as $t){
								$options[$t->so_id] = $t->tpd_name;
							}
							if(!$newsletter)
								echo form_dropdown('template', $options);
							else
								echo form_dropdown('template', $options, $newsletter->tpd_id);
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
    		interface.newsletter.validate('form.frmNewsletter');
    	</script>
    </body>
</html>