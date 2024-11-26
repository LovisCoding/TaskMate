<?php
include 'tabs.php';
include 'filter.php';
include 'export.php';
include 'card.php';
include __DIR__.'/../../components/CalendarRange.php';
include __DIR__.'/../../components/CalendarItemTitle.php';
include 'newTache.php';

$taches = [
	"2024-01-01" => [
		["Tâche 1", "Texte descriptif ici.", 3, "En retard"],
		["Tâche 2", "Texte descriptif ici.", 4, "En cours"],
		["Tâche 3", "Texte descriptif ici.", 4, "Terminée"]
	],
	"2024-01-02" => [
		["Tâche 4", "Lorem ipsum dolor sit", 4, "Bloquée"],
		["Tâche 5", "Description supplémentaire.", 2, "Pas commencée"]
	],
	"2024-01-03" => [
		["Tâche 6", "Texte ici.", 2, "En retard"],
		["Tâche 7", "Un autre texte descriptif.", 3, "En cours"]
	],
	"2024-01-04" => [
		["Tâche 6", "Texte ici.", 1, "Bloquée"],
		["Tâche 7", "Un autre texte descriptif.", 3, "Bloquée"]
	],
	"2024-01-05" => [
		["Tâche 6", "Texte ici.", 2, "Terminée"],
		["Tâche 7", "Un autre texte descriptif.", 3, "Terminée"]
	]
];

?>

<div>
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
</div>

<div class="d-flex justify-content-center mt-4">
	<?= CalendarRange((new DateTime())->modify('-7 days'), 5) ?>
</div>

<div class="container mt-4">
	<div class="d-flex justify-content-between">
		<?php foreach ($taches as $dateString => $tasks): ?>
			<div>
				<?php
					$date = new DateTime($dateString);
				?>
				<?= CalendarItemTitle($date) ?>
				
				<?php foreach ($tasks as $task): ?>
					<div class="mb-3 mt-3">
						<?= generateCard(
							htmlspecialchars($task[0]),
							htmlspecialchars($task[1]),
							htmlspecialchars($task[2]),
							htmlspecialchars($task[3])
						) ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?=view('pages/home/filterPanel')?>
