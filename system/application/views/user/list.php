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
						<col width="94%" />
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
						if($users){
							foreach($users as $u){?>
						<tr>
							<td><a href="<?=site_url('user/edit/'.$u->so_id)?>"><?=$u->usd_name?> (<?=$u->usd_username?>)</a></td>
							<td>
								<a href="<?=site_url('user/edit/'.$u->so_id)?>" class="edit" title="<?=$this->lang->line('interface_edit')?>"><?=$this->lang->line('interface_edit')?></a>
								<a href="<?=site_url('user/delete/'.$u->so_id)?>" class="delete" title="<?=$this->lang->line('interface_delete')?>"><?=$this->lang->line('interface_delete')?></a>
							</td>
						</tr>
							<?}
						}else{?>
							<tr>
								<td colspan="2">Não existem templates.</td>
							</tr>
						<?}?>
					</tbody>
				</table>
				<a class="new" href="<?=site_url('user/edit')?>" title="<?=$this->lang->line('interface_new')?>"><?=$this->lang->line('interface_new')?></a>
	    	</div>
    	</div>
    	<script type="text/javascript">
    		$('table tbody tr td a.delete').click(function(){
        		if(!confirm('Realmente deseja excluir este template?')){
					return false;
                }
        	});
    	</script>
    </body>
</html>