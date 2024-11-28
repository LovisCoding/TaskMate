<?php
$imgSrc = base_url("assets/imgs/export.svg");

if (!isset($currentPage)) $currentPage = "state";
else $currentPage = explode('home/', $currentPage)[1];
?>

<form action="/home/exportData" method="POST">
	<a class="export" id="btn-export" type="submit">
		<button class="btn btn-link export d-flex align-items-center">
			Exporter
			<img src="<?= $imgSrc ?>" alt="filter" width="20px" height="20px" />
		</button>
	</a>
	<input style="display:none;margin:0;padding:0;" hidden name="exportType" value="<?= $currentPage ?>" />
	<?php foreach ($tasks as $dateString => $taskes): ?>
		<?php foreach ($taskes as $index => $task): ?>
			<input style="display:none;margin:0;padding:0;" hidden name="tasks[<?= $dateString ?>][<?= $index ?>][name]" value="<?= esc($task['name']) ?>" />
			<input style="display:none;margin:0;padding:0;" hidden name="tasks[<?= $dateString ?>][<?= $index ?>][description]" value="<?= esc($task['description']) ?>" />
			<input style="display:none;margin:0;padding:0;" hidden name="tasks[<?= $dateString ?>][<?= $index ?>][priority]" value="<?= esc($task['priority']) ?>" />
			<input style="display:none;margin:0;padding:0;" hidden name="tasks[<?= $dateString ?>][<?= $index ?>][current_state]" value="<?= esc($task['current_state']) ?>" />
			<input style="display:none;margin:0;padding:0;" hidden name="tasks[<?= $dateString ?>][<?= $index ?>][id_task]" value="<?= esc($task['id_task']) ?>" />
		<?php endforeach; ?>
	<?php endforeach; ?>



</form>