<?= form_open("/task/validate/$id") ?>

<div class="container mt-3">
	<div class="row" style="width: 100%;">

	<?= view('components/Input', ['name' => 'task_state', 'type' => 'hidden', 'value' => $state]) ?>


		<?= view('pages/viewTask/ViewLeft', ['title'=>$title, 'commentaries'=>$commentaries, 'isChecked' => $state !== 'Pas commencée'] ) ?>
		<div class="col-sm-12 col-lg-2"></div>
		<?= view('pages/viewTask/ViewRight', ['priority'=>$priority, 'date'=>$date, 'isBlockedList'=>$isBlockedList, 'blockList'=>$blockList]) ?>


	</div>
</div>

<?= form_close(); ?>
