<?php
$date = new DateTime($date);
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

<div class="d-flex justify-content-center mt-4">
	<?= view('components/CalendarRange', ['date' => $date, 'nb' => $nb]) ?>
</div>

<!-- Conteneur défilant horizontal -->
<div class="container mt-4">
	<div class="overflow-auto">
		<div class="d-flex flex-nowrap align-items-start">
			<?php foreach ($tasks as $dateString => $taskes): ?>
				<div class="d-flex flex-column me-4 mb-4 col">
					<?php
					$date = new DateTime($dateString);
					?>
					<div class="mb-3">
						<?= view('components/CalendarItemTitle', ['date' => $date]) ?>
					</div>
					<?php foreach ($taskes as $task): ?>
						<div class="mb-3">
							<?= view('components/Card', [
								'title' => htmlspecialchars($task['name']),
								'text' => htmlspecialchars($task['description']),
								'priority' => (int) htmlspecialchars($task['priority']),
								'status' => htmlspecialchars($task['current_state']),
								'color' => false,
								'id'=> (int) htmlspecialchars($task['id_task']),
							]) ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?= view('pages/home/filterPanel') ?>