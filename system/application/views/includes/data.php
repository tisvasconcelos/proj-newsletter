<?
echo form_hidden('javascript', 'jquery-1.4.2.min');
echo form_hidden('base_path', $this->config->config['base_path']);
echo form_hidden('base_full_path', $this->config->config['base_path']."system/application/views/");
echo form_hidden('language', $this->config->config['language']);
?>