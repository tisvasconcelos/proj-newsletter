<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Content-Disposition: attachment; filename=".str_ireplace(" ", "_", $mailing->mld_name).".xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-us">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?=$mailing->mld_name?></title>
    </head>
    <body>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<colgroup>
				<col width="50%" />
				<col width="50%" />
			</colgroup>
			<thead>
				<tr align="left">
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
    </body>
</html>