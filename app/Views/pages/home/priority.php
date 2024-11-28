<?php
$priorityColumns = [
	4 => [],
	3 => [],
	2 => [],
	1 => []
];

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
		$priorityIndicators .= "<span style=\"".($i == 3 ? 'margin-right: 0;' : '')."\" class=\"indicator $color\"></span>";
	}

	return $priorityIndicators;
}
?>

<div>
	<div class="pt-4"></div>
	<div class="d-flex justify-content-between mx-4" id="vues">
		<div class="left d-flex">
			<?= view('components/Tabs') ?>
			<?= view('components/Export', ['redirect'=>'/home', 'tasks' => $tasks, 'currentPage' => $_SERVER['PHP_SELF']]) ?>
			<?= view('components/Filter') ?>
		</div>
		<div class="right">
			<?= view('components/NewTache') ?>
		</div>
	</div>
</div>

<ul class="pagination" id="pagination">
	<?= $pager->links('default', 'default_paginate') ?>
</ul>

<div class="container mt-4 justify-content-center">
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
							<?php if (empty($tasksByPriority)): ?>
								<div class="mb-3 text-center text-muted">Aucune tâche sur cette page</div>
							<?php else: ?>
								<?php foreach ($tasksByPriority as $task): ?>
									<div class="mb-3 d-flex justify-content-center">
										<?= view('components/Card', [
											'date' => $task['deadline'],
											'title' => htmlspecialchars($task['name']),
											'text' => htmlspecialchars($task['description']),
											'priority' => (int)htmlspecialchars($task['priority']),
											'status' => htmlspecialchars($task['current_state']),
											'color' => false,
											'id'=> (int) htmlspecialchars($task['id_task']),
											'retard' => htmlspecialchars($task['retard'])
										]) ?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>