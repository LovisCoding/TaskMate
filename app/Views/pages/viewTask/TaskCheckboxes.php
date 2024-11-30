<!-- 

Paramètres

taskList
	- id
	- name

-->

<div class="overflow-y-scroll task-checkboxes">

	<?php foreach ($taskList as $task) { ?>
		<div class="input-group mb-2">
			<div class="input-group-text w-100 overflow-hidden d-flex justify-content-between" style="font-size: 0.8rem;">
				<div>
					<input <?= $task['isChecked'] ? 'checked' : '' ?> class="form-check-input mt-0" type="checkbox" value="<?= $task['id'] ?>" name="<?= $name ?>" id="<?= $name . $task['id'] ?>">
					<label class="ms-3" for="<?= $name . $task['id'] ?>" style="text-overflow: ellipsis;overflow: hidden;"><?= $task['name'] ?></label>
				</div>
				<a href="/task/<?= $task['id'] ?>">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
						<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 19.5-15-15m0 0v11.25m0-11.25h11.25" />
					</svg>
				</a>
			</div>
		</div>
	<?php } ?>

</div>

