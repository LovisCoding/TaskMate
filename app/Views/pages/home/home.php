<?php
include 'tabs.php';
include 'filter.php';
include 'export.php';
include 'card.php';
include __DIR__.'/../../components/CalendarRange.php';
include __DIR__.'/../../components/CalendarItemTitle.php';
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
	<?=CalendarRange(new DateTime(), 5)?>
</div>
<?php
$_GET['date'] = '2021-01-01';
$_GET['nb'] = 7;

$nb = $_GET['nb'];
$taches = [
	["Tâche 1", "Texte descriptif ici.", 3, "en retard"],
	["Tâche 2", "Texte descriptif ici.", 4, "en cours"],
	["Tâche 3", "Texte descriptif ici.", 4, "terminé"],
	["Tâche 4", "Lorem ipsum dolor sit", 4, "bloqué"],
	["Tâche 5", "Description supplémentaire.", 2, "en attente"],
	["Tâche 6", "Texte ici.", 5, "à valider"],
	["Tâche 7", "Un autre texte descriptif.", 3, "prioritaire"]
];
?>

<div class="container mt-4">
	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-<?= $nb ?> g-4">
		<?php foreach ($taches as $tache): ?>
			<div class="col">
				<?=CalendarItemTitle()?>
				<?=generateCard($tache[0], $tache[1], $tache[2], $tache[3]);?>
			</div>
		<?php endforeach; ?>
	</div>
</div>