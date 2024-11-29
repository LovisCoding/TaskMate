<?php 
	if (!isset($value)) $value = "";
	if (!isset($labelClass)) $labelClass = "";
	if (!isset($required)) $required = false;
?>

<div>
	<?php if (isset($label)) { ?>
	<label for="<?= $name ?>" class="form-label fs-5 <?= $labelClass ?>"><?= $label ?></label>
	<?php } ?>
	<input 
		value="<?= $value ?>" 
		type="<?= $type ?>" 
		class="form-control" 
		id="<?= $name ?>" 
		name="<?= $name ?>" 
		placeholder="<?= $placeholder ?? "" ?>"
		maxlength="<?= $maxlength ?? "" ?>"
		<?= $required ? 'required' : '' ?>
	>
</div>
