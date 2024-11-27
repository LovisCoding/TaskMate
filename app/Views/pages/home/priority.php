<?php
$priorityColumns = [];
$priorityIndicators = '';

foreach ($tasks as $dateString => $taskes) {
	foreach ($taskes as $task) {
		$priorityColumns[$task['priority']][] = $task;
	}
}

function generatePriorityIndicators($priority)
{
	$priorityIndicators = '';
	for ($i = 0; $i < 4; $i++) {
		$color = $i < $priority ? 'black' : 'gray';
		$priorityIndicators .= "<span class=\"indicator $color\"></span>";
	}

	return $priorityIndicators;
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
<?= view('components/Pagination') ?>
<div class="container mt-4">
	<div class="row justify-content-center">
		<?php foreach ($priorityColumns as $priority => $tasksByPriority): ?>
			<div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4 d-flex justify-content-center">
				<div class="d-flex flex-column p-3 h-100 justify-content-start w-100">
					<div class="mb-3 text-center">
						<div class="d-flex align-items-center justify-content-center mt-2">
							<?= generatePriorityIndicators($priority) ?>
						</div>
						<div class="line"></div>
					</div>
					<div class="flex-grow-1 d-flex justify-content-center">
						<div class="w-100">
							<?php foreach ($tasksByPriority as $task): ?>
								<div class="mb-3 d-flex justify-content-center">
									<?= view('components/Card', [
										'title' => htmlspecialchars($task['name']),
										'text' => htmlspecialchars($task['description']),
										'priority' => (int)htmlspecialchars($task['priority']),
										'status' => htmlspecialchars($task['current_state']),
										'color' => false,
										'id'=> (int) htmlspecialchars($task['id_task'])
									]) ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>