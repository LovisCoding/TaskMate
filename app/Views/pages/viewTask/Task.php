<?= form_open("/task/validate/$id") ?>

<div class="container mt-3">
	<div class="d-flex justify-content-start mb-3 button-container">
		<?= view('components/Button', ['text' => "<strong>Supprimer</strong>", 'type' => 'danger', 'name' => 'action', 'value' => 'delete', 'disabled' => $id == -1, 'class' => 'me-2 fw-bold', 'svgName' => 'delete']) ?>
		
		<?php if ($state == "En cours") { ?>
			<?= view('components/Button', ['text' => "<strong>Terminer la tâche</strong>", 'type' => null, 'name' => 'action', 'value' => 'complete', 'disabled' => false, 'svgName' => 'check']) ?>
		<?php } else { ?>
			<?= view('components/Button', ['text' => "<strong>Enregistrer les modifications</strong>", 'type' => null, 'name' => 'action', 'value' => 'save', 'disabled' => false, 'svgName' => 'download']) ?>
		<?php } ?>
	</div>
	<div class="row" style="width: 100%;">
		<?= view('components/Input', ['name' => 'task_state', 'type' => 'hidden', 'value' => $state]) ?>
		<?= view('pages/viewTask/ViewLeft', ['title'=>$title, 'commentaries'=>$commentaries, 'isChecked' => $state !== 'Pas commencée'] ) ?>
		<div class="col-sm-12 col-lg-2"></div>
		<?= view('pages/viewTask/ViewRight', ['priority'=>$priority, 'date'=>$date, 'isBlockedList'=>$isBlockedList, 'blockList'=>$blockList]) ?>
	</div>
</div>

<?= form_close(); ?>
