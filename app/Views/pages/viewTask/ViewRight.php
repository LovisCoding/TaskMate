<div class="col-sm-12 col-lg-4">
	<div class="shadow p-5 pt-3 bg-white rounded-2" style="height: fit-content;">
		<div class="d-flex flex-column gap-4">
			<div>
				<div class="d-flex justify-content-between align-items-center">
					<label class="fs-5 mb-2 fw-bold" for="">Priorité</label>
					<?= view('components/PriorityBtn', ['nb' => $priority]) ?>
				</div>
				<select id="priority" class="form-select mb-2 d-none" name="task_priority">
					<option value="1" <?= $priority == 1 ? 'selected' : '' ?>>1</option>
					<option value="2" <?= $priority == 2 ? 'selected' : '' ?>>2</option>
					<option value="3" <?= $priority == 3 ? 'selected' : '' ?>>3</option>
					<option value="4" <?= $priority == 4 ? 'selected' : '' ?>>4</option>
				</select>
			</div>
			<?= view('components/Input', [
				'name' => 'task_date',
				'type' => 'date',
				'label' => 'Date d\'échéance :',
				'value' => $date->format('Y-m-d'),
				'labelClass' => 'fw-bold'
			]) ?>
			<div>
				<label for="taskGroup" class="fs-5 mb-2 fw-bold">Groupe de tâches :</label>
				<select id="taskGroup" name="task_group" class="form-select">
					<option value="" <?= empty($groupId) ? 'selected' : '' ?>>Aucun groupe</option>
					<?php foreach ($groups as $group): ?>
						<option value="<?= $group['id'] ?>" <?= (!empty($groupId) && $groupId == $group['id']) ? 'selected' : '' ?>>
							<?= esc($group['name']) ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="d-flex flex-column">
				<span class="mb-2 fs-5 fw-bold">Dépend de :</span>
				<?= view('pages/viewTask/TaskCheckboxes', [
					'name' => 'task_isBlockedList[]',
					'taskList' => $isBlockedList
				]) ?>
			</div>
			<div class="d-flex flex-column">
				<span class="mb-2 fs-5 fw-bold">Sont dépendantes :</span>
				<?= view('pages/viewTask/TaskCheckboxes', [
					'name' => 'task_blockList[]',
					'taskList' => $blockList
				]) ?>
			</div>
		</div>
	</div>
</div>