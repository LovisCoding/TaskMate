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

<ul class="pagination">
	<?= $pager->links('default', 'default_paginate') ?>
</ul>

<div class="container justify-content-center mt-5">
	<div class="row justify-content-center">
		<?php foreach ($tasks as $groupName => $taskes): ?>
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				<div class="mb-3 text-center">
					<div class="d-flex justify-content-center mt-2">
						<p class="fw-bold mb-0"><?= htmlspecialchars($groupName) ?></p>
					</div>
					<div class="line"></div>
				</div>
				<div class="flex-grow-1 d-flex justify-content-center">
					<div class="w-100">
						<?php if (empty($taskes)): ?>
							<p class="text-center text-muted">Aucune tâche</p>
						<?php else: ?>
							<?php foreach ($taskes as $task): ?>
								<div class="mb-3 d-flex justify-content-center">
									<?= view('components/Card', [
										'date' => $task['deadline'],
										'title' => htmlspecialchars($task['name']),
										'text' => htmlspecialchars($task['description']),
										'priority' => (int) htmlspecialchars($task['priority']),
										'color' => true,
										'id' => (int) htmlspecialchars($task['id_task']),
										'retard' => htmlspecialchars($task['retard'] ?? ''),
									]) ?>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
