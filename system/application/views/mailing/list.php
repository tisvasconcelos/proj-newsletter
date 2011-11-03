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
    	<?include($this->config->config['path'].'includes/header.php');?>
    	<div id="main">
    		<div class="center">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<colgroup>
						<col width="92%" />
						<col />
					</colgroup>
					<thead>
						<tr>
							<th><?=$this->lang->line('interface_name')?></th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<?
						if($mailings){
							foreach($mailings as $m){?>
						<tr>
							<td><a href="<?=site_url('mailing/list/'.$m->mld_id)?>"><?=$m->mld_name?></a></td>
							<td>
								<a href="<?=site_url('mailing/list/'.$m->mld_id)?>" class="list" title="<?=$this->lang->line('interface_list')?>"><?=$this->lang->line('interface_list')?></a>
								<a href="<?=site_url('mailing/export/'.$m->mld_id)?>" target="_blank" class="export" title="Exportar">Exportar</a>
								<a href="<?=site_url('mailing/delete/'.$m->mld_id)?>" class="delete" title="<?=$this->lang->line('interface_delete')?>"><?=$this->lang->line('interface_delete')?></a>
							</td>
						</tr>
							<?}
						}else{?>
							<tr>
								<td colspan="2">Não existem mailings.</td>
							</tr>
						<?}?>
					</tbody>
				</table>
				<a class="new" href="<?=site_url('mailing/edit')?>" title="<?=$this->lang->line('interface_new')?>"><?=$this->lang->line('interface_new')?></a>
	    	</div>
    	</div>
    	<script type="text/javascript">
    		$('table tbody tr td a.delete').click(function(){
        		if(!confirm('Realmente deseja excluir esta lista de mailing?')){
					return false;
                }
        	});
    	</script>
    </body>
</html>