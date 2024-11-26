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
    <div class="row">
        <?php foreach ($tasks as $dateString => $taskes): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <?php
                    $date = new DateTime($dateString);
                ?>
                <?= CalendarItemTitle($date) ?>

                <?php foreach ($taskes as $task): ?>
                    <div class="mb-3 mt-3">
                        <?= generateCard(
                            htmlspecialchars($task['name']),
                            htmlspecialchars($task['description']),
                            htmlspecialchars($task['priority']),
                            htmlspecialchars($task['current_state'])
                        ) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>