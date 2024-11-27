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

<div class="container mt-4 justify-content-center">
	<div class="d-flex flex-wrap align-items-start">
		<?php 
		$priorityColumns = [];

		foreach ($tasks as $dateString => $taskes) {
			foreach ($taskes as $task) {
				$priorityColumns[$task['priority']][] = $task;
			}
		}

		krsort($priorityColumns); 
		?>

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