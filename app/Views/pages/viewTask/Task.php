<?= form_open("/task/validate/$id") ?>

<div class="container mt-3">
	<div class="d-flex justify-content-start mb-3 button-container mt-3">
		<?= view('components/Button', ['text' => "<strong>Supprimer</strong>", 'type' => 'danger', 'name' => 'action', 'value' => 'delete', 'disabled' => $id == -1, 'class' => 'me-2 fw-bold', 'svgName' => 'delete']) ?>
		<?= view('components/Button', ['text' => "<strong>Terminer la tâche</strong>", 'type' => null, 'name' => 'action', 'value' => 'complete', 'disabled' => $state !== 'En cours', 'svgName' => 'check']) ?>
		<?= view('components/Button', ['text' => "<strong>Enregistrer les modifications</strong>", 'type' => null, 'name' => 'action', 'value' => 'save', 'disabled' => $state == 'Terminée', 'svgName' => 'download']) ?>
	</div>
	<div class="row w-100">
		<?= view('components/Input', ['name' => 'task_state', 'type' => 'hidden', 'value' => $state]) ?>
		<?= view('pages/viewTask/ViewLeft', ['title'=>$title, 'commentaries'=>$commentaries, 'isChecked' => $started, "disabled" => $state == 'Terminée' || $state == 'Bloquée' ] ) ?>
		<div class="col-sm-12 col-lg-2"></div>
		<?= view('pages/viewTask/ViewRight', ['priority'=>$priority, 'date'=>$date, 'isBlockedList'=>$isBlockedList, 'blockList'=>$blockList, 'groups' => $groups, 'groupId' => $groupId]) ?>
	</div>
</div>

<?= form_close(); ?>
