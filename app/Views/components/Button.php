<?php
	$color = 'btn-grey';
	if ($type == 'danger') $color= 'btn-danger';
	if ($type == 'marron') $color= 'btn-marron';
?>

<div class="button">
	<button class="btn d-flex align-items-center w-100 justify-content-center <?= $color ?>" id="<?= $id ?>">
		<?php if ($svgName) { ?>
			<span> <?= $text ?> </span>
			<img class="mx-2"  src="/assets/imgs/<?= $svgName ?>.svg" alt="<?= $svgName ?>" width="20px" height="20px">
		<?php } ?>
	</button> 
</div>
