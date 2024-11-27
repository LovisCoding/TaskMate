<!-- 

Paramètres
-----

taskList
	- id
	- name

-->

<div class="overflow-y-scroll" style="max-height: 15rem;">

	<?php foreach ($taskList as $task) { ?>
		<div class="input-group mb-3">
			<div class="input-group-text w-100">
				<input <?= $task['isChecked'] ? 'checked':'' ?> class="form-check-input mt-0" type="checkbox" value="<?= $task['id'] ?>" name="<?= $name ?>" id="<?= $name.$task['id'] ?>">
				<label class="ms-3" for="<?= $name.$task['id'] ?>"><?= $task['name'] ?></label>
			</div>
		</div>
	<?php } ?>

</div>