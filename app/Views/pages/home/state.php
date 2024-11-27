<?php
$stateColumns = [];

foreach ($tasks as $dateString => $taskes) {
	foreach ($taskes as $task) {
		$stateColumns[$task['current_state']][] = $task;
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

<div class="container mt-5">
	<div class="row justify-content-center">
		<?php foreach ($stateColumns as $state => $tasksByState): ?>
			<div class="col-12 col-sm-6 col-md-4 col-lg-2 col-xl-2">
				<div class="mb-3 text-center">
					<div class="d-flex justify-content-center mt-2">
						<p class="fw-bold"><?= htmlspecialchars($state) ?></p>
					</div>
					<div class="line"></div>
				</div>

				<div class="flex-grow-1 d-flex justify-content-center">
					<div class="w-100">
						<?php foreach ($tasksByState as $task): ?>
							<div class="mb-3 d-flex justify-content-center">
								<?= view('components/Card', [
									'title' => htmlspecialchars($task['name']),
									'text' => htmlspecialchars($task['description']),
									'priority' => (int) htmlspecialchars($task['priority']),
									'status' => htmlspecialchars($task['current_state']),
									'color' => true
								]) ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>