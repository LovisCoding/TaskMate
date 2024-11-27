<?php
$arr = [
	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus, purus at fermentum pulvinar, dolor nibh auctor odio, vel consequat purus justo et dolor. Curabitur facilisis tortor velit, sit amet tempus augue mollis non. Suspendisse sollicitudin.',
	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus, purus at fermentum pulvinar, dolor nibh auctor odio, vel consequat purus justo et dolor. Curabitur facilisis tortor velit, sit amet tempus augue mollis non. Suspendisse sollicitudin.',
	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus, purus at fermentum pulvinar, dolor nibh auctor odio, vel consequat purus justo et dolor. Curabitur facilisis tortor velit, sit amet tempus augue mollis non. Suspendisse sollicitudin.'
];
?>

<div class="col-sm-12 col-lg-6 p-5 bg-white rounded-2">
	<?= view('components/Input', ['name' => 'task_name', 'label' => null, 'type' => 'text', 'placeholder' => '', 'value' => $title]) ?>
	<textarea name="task_desc" class="form-control mb-3 mt-3" placeholder="Description" rows="5"> <?= $description ?> </textarea>
	<?= view('pages/viewTask/Commentaries', ['commentaires' => $commentaries, 'pager' => $pager]) ?>
	<div class="d-flex justify-content-between mt-5">

		<?php if ($id != -1) { ?>
			<?= view('components/Button', ['text' => "Supprimer", 'type' => 'danger', 'name' => 'action', 'value' => 'delete']) ?>
		<?php } ?>

		<?php if ($state == "En cours") { ?>
			<?= view('components/Button', ['text' => "Terminer la tâche", 'type' => null, 'name' => 'action', 'value' => 'complete']) ?>
		<?php } else { ?>
			<?php if ($state !== "Terminée") { ?>
				<?= view('components/Button', ['text' => "Commencer la tâche", 'type' => null, 'name' => 'action', 'value' => 'start']) ?>
			<?php } ?>
		<?php } ?>
	</div>
</div>