<div class="shape__list" id="priorityShape">
	<?php for ($i=0; $i < $nb; $i++) {  ?>
		<button class="shape shape__active" data-id="<?=($i+1)?>" id="btn-shape-<?=$i?>"></butt>
	<?php } ?>
	<?php for ($i=$nb; $i < 4; $i++) {  ?>
		<button class="shape" data-id="<?=($i+1)?>" id="btn-shape-<?=$i?>"></button>
	<?php } ?>
</div>
