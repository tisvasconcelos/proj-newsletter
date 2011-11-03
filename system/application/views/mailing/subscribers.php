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
						<col width="50%" />
						<col width="50%" />
					</colgroup>
					<thead>
						<tr>
							<th><?=$this->lang->line('interface_name')?></th>
							<th><?=$this->lang->line('interface_email')?></th>
						</tr>
					</thead>
					<tbody>
						<?foreach($subscribers as $s){?>
						<tr>
							<td><?=$s->scd_name?></td>
							<td><?=$s->scd_email?></td>
						</tr>
						<?}?>
					</tbody>
				</table>
	    	</div>
    	</div>
    </body>
</html>