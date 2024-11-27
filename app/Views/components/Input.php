<div>
	<?php if (isset($label)) { ?>
	<label for="<?= $name ?>" class="form-label fs-5"><?= $label ?></label>
	<?php } ?>
	<input type="<?= $type ?>" class="form-control" id="<?= $name ?>" name="<?= $name ?>" placeholder="<?= $placeholder ?? "" ?>">
</div>
