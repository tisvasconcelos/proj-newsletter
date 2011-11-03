<?if($start>=$total){?>
	<a href="#" class="closeModal">Finalizado, fechar.</a>
<?}else{?>
	<span>Status de envio: <?=$start?> de <?=$total?></span>
<?}?>