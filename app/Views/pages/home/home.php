<?php
include 'tabs.php';
include 'filter.php';
include 'export.php';
include 'card.php';
include __DIR__.'/../../components/CalendarRange.php';
?>
<div class="d-flex" id="vues">
	<?=tabs()?>
	<?=export()?>
	<?=filter()?>
</div>

<?=CalendarRange()?>
<div>
	<?=generateCard("Tâche 1", "Texte descriptif ici.", 3, "en retard");?>
	<?=generateCard("Tâche 1", "Texte descriptif ici.", 4, "en cours");?>
	<?=generateCard("Tâche 1", "Texte descriptif ici.", 4, "terminé");?>
	<?=generateCard("Tâche 1", "Lorem ipsum dolor sit", 4, "bloqué");?>
</div>