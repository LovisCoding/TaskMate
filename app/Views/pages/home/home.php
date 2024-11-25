<?php
include 'tabs.php';
include 'filter.php';
include 'export.php';
include 'newTache.php';
?>
<div class="pt-4"></div>
<div class="d-flex justify-content-between mx-4" id="vues">
	<div class="left d-flex">
		<?= tabs() ?>
		<?= export() ?>
		<?= //filter()'' ?>
	</div>
	<div class="right">
	<?= newTache() ?>	
	</div>	
	
</div>