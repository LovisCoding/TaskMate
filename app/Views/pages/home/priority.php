<?php 
	$priorityColumns = [];

	foreach ($tasks as $dateString => $taskes) {
		foreach ($taskes as $task) {
			$priorityColumns[$task['priority']][] = $task;
		}
	}
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

<div class="container mt-4 justify-content-center">
	<div class="d-flex flex-wrap align-items-start">

		<?php foreach ($priorityColumns as $priority => $tasksByPriority): ?>
			<div class="d-flex flex-column me-4 mb-4 mt-5">
				<div class="mb-3 text-center">
					<?php 
					$priorityIndicators = '';
					for ($i = 0; $i < 4; $i++) {
						$color = $i < $priority ? 'black' : 'gray';
						$priorityIndicators .= "<span class=\"indicator $color\"></span>";
					}
					$priorityIndicators .= "<div class=\"line\"></div>";
					?>
					<div class="d-flex align-items-center justify-content-center mt-2">
					<?= $priorityIndicators ?>
					</div>
				</div>
				<?php foreach ($tasksByPriority as $task): ?>
					<div class="mb-3">
						<?= view('components/Card', [
							'title' => htmlspecialchars($task['name']),
							'text' => htmlspecialchars($task['description']),
							'priority' => (int)htmlspecialchars($task['priority']),
							'status' => htmlspecialchars($task['current_state']),
							'color' => false
						]) ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>