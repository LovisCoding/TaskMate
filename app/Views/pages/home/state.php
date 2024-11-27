<?php
include __DIR__.'/../../components/Card.php'
?>

<div>
	<div class="pt-4"></div>
	<div class="d-flex justify-content-between mx-4" id="vues">
		<div class="left d-flex">
			<?= view('components/Tabs') ?>
			<?= view('components/Export') ?>
			<?= view('components/Filter') ?>
		</div>
		<div class="right">
			<?= view('components/NewTache') ?>
		</div>
	</div>
</div>

<div class="container mt-4">
	<div class="row">
		<?php 
		$stateColumns = [];

		foreach ($tasks as $dateString => $taskes) {
			foreach ($taskes as $task) {
				$stateColumns[$task['current_state']][] = $task;
			}
		}

		ksort($stateColumns);
		?>

		<?php foreach ($stateColumns as $state => $tasksByState): ?>
			<div class="col-12 col-sm-6 col-md-4 col-lg-2 d-flex flex-column">
				<div class="mb-3 text-center">
					<h4><?= htmlspecialchars($state) ?></h4>
				</div>
				<?php foreach ($tasksByState as $task): ?>
					<div class="mb-3">
						<?= generateCard(
							htmlspecialchars($task['name']),
							htmlspecialchars($task['description']),
							htmlspecialchars($task['priority']),
							htmlspecialchars($task['current_state']),
							true
						) ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>