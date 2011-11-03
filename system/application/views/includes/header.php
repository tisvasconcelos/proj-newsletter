		<?php 
		if(!isset($_SESSION['user_so_id'])){
			redirect('/', 'refresh');
		}
		?>
    	<div id="header">
    		<div class="center">
    			<h1><a href="<?=site_url()?>" title="Newsletter">Newsletter</a></h1>
    			<?if(isset($_SESSION['user_so_id'])){?>
    			<ul id="menu">
    				<li><a href="<?=site_url()?>" title="<?=$this->lang->line('interface_newsletter')?>"><?=$this->lang->line('interface_newsletter')?></a></li>
					<li><a href="<?=site_url('template')?>" title="<?=$this->lang->line('interface_template')?>"><?=$this->lang->line('interface_template')?></a></li>
					<li><a href="<?=site_url('mailing')?>" title="<?=$this->lang->line('interface_mailing')?>"><?=$this->lang->line('interface_mailing')?></a></li>
					<?if($_SESSION['usd_user']->usd_level==1){?>
					<li><a href="<?=site_url('user')?>" title="<?=$this->lang->line('interface_users')?>"><?=$this->lang->line('interface_users')?></a></li>
					<?}?>
					<li><a href="<?=site_url('myprofile')?>" title="<?=$this->lang->line('interface_myprofile')?>"><?=$this->lang->line('interface_myprofile')?></a></li>
    				<li class="last"><a href="<?=site_url('logout')?>" title="<?=$this->lang->line('interface_logout')?>"><?=$this->lang->line('interface_logout')?></a></li>
    			</ul>
    			<?}?>
    		</div>
    	</div>