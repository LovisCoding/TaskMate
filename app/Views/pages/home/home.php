<?php
include 'tabs.php';
include 'filter.php';
include 'export.php';
include 'card.php';
include __DIR__.'/../../components/CalendarRange.php';
include 'newTache.php';
?>
<div class="pt-4"></div>
<div class="d-flex justify-content-between mx-4" id="vues">
	<div class="left d-flex">
		<?= tabs() ?>
		<?= export() ?>
		<?= filter() ?>
	</div>
	<div class="right">
	<?= newTache() ?>	
	</div>	
	
</div>
<div class="d-flex justify-content-center mt-4">
	<?=CalendarRange()?>
</div>
<div>
	<?=generateCard("Tâche 1", "Texte descriptif ici.", 3, "en retard");?>
	<?=generateCard("Tâche 1", "Texte descriptif ici.", 4, "en cours");?>
	<?=generateCard("Tâche 1", "Texte descriptif ici.", 4, "terminé");?>
	<?=generateCard("Tâche 1", "Lorem ipsum dolor sit", 4, "bloqué");?>
</div>