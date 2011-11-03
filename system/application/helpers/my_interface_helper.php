<?php
function call($src = '')
{
	$RTR =& load_class('Router');
	$class  = $RTR->fetch_class();
	$CI = new $class();
	$path = site_url().$CI->config->item('cms_path')."system/application/views/".$src;
	return $path;
}
?>