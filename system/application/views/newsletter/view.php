<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-us">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Expires" content="Fri, 19 Nov 2010 23:59:59 GMT">
        <title><?=$newsletter->nld_name?></title>
    </head>
    <body>
    	<?
    	$html = str_replace('[nome]',$subscriber->scd_name,$template->tpd_html);
    	$html = str_replace($this->config->config['base_path'],site_url(),$html);
    	?>
    	<?=$html?>
    </body>
</html>