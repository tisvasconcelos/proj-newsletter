	    		<div id="userInfo">
	    			<p>
	    				<span id="ibisCode">IBIS 10025</span><br />
	    				<strong><?=$this->lang->line('interface_welcome')?> <?=$_SESSION['name']?></strong><br />
	    				<a href="mailto:email@email.com" title="email@email.com">email@email.com</a><br />
	    				<?=$this->lang->line('interface_date_'.strtolower(date('l')))?>, 25 de Outubro de 2010	
	    			</p>
	    			<ul>
	    				<li><a class="user" href="<?=site_url('myprofile')?>" title="<?=$this->lang->line('interface_my_profile')?>"><?=$this->lang->line('interface_my_profile')?></a></li>
	    			</ul>
	    		</div>