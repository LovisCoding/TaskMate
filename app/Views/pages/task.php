
<?= view('components/OpenModal', ['id' => 'modalAddIsBlocked', 'title' => 'Ajouter un élément bloqué']); ?>
	<?= form_open("/task/addIsBlockedBy") ?>
		<div>
			<button value="1" name="idTask" type="submit" class="btn w-100 p-0">
				<div class="d-flex gap-3 p-3 border-bottom" style="border-color: var(--grey6-color);">
					<?= view('components/Plus') ?>
					<span>Nom de la tâche 4</span>
				</div>
			</button>
			<button value="2" name="idTask" type="submit" class="btn w-100 p-0">
				<div class="d-flex gap-3 p-3 border-bottom" style="border-color: var(--grey6-color);">
					<?= view('components/Plus') ?>
					<span>Nom de la tâche 5</span>
				</div>
			</button>
			<button value="3" name="idTask" type="submit" class="btn w-100 p-0">
				<div class="d-flex gap-3 p-3 border-bottom" style="border-color: var(--grey6-color);">
					<?= view('components/Plus') ?>
					<span>Nom de la tâche 6</span>
				</div>
			</button>
		</div>
	<?= form_close() ?>
<?= view('components/CloseModal'); ?>

<?= view('components/OpenModal', ['id' => 'modalAddBlock', 'title' => 'Ajouter un élément bloquant']); ?>
	<?= form_open("/task/addBlock") ?>
		<div>
			<button value="1" name="idTask" type="submit" class="btn w-100 p-0">
				<div class="d-flex gap-3 p-3 border-bottom" style="border-color: var(--grey6-color);">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
					</svg>
					<span>Nom de la tâche 1</span>
				</div>
			</button>
			<button value="2" name="idTask" type="submit" class="btn w-100 p-0">
				<div class="d-flex gap-3 p-3 border-bottom" style="border-color: var(--grey6-color);">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
					</svg>
					<span>Nom de la tâche 2</span>
				</div>
			</button>
			<button value="3" name="idTask" type="submit" class="btn w-100 p-0">
				<div class="d-flex gap-3 p-3 border-bottom" style="border-color: var(--grey6-color);">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="icon">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
					</svg>
					<span>Nom de la tâche 3</span>
				</div>
			</button>
		</div>
	<?= form_close() ?>
<?= view('components/CloseModal'); ?>


<?= form_open("/"); ?>

<?php

$arr = ['Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus, purus at fermentum pulvinar, dolor nibh auctor odio, vel consequat purus justo et dolor. Curabitur facilisis tortor velit, sit amet tempus augue mollis non. Suspendisse sollicitudin.', 
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus, purus at fermentum pulvinar, dolor nibh auctor odio, vel consequat purus justo et dolor. Curabitur facilisis tortor velit, sit amet tempus augue mollis non. Suspendisse sollicitudin.', 
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus, purus at fermentum pulvinar, dolor nibh auctor odio, vel consequat purus justo et dolor. Curabitur facilisis tortor velit, sit amet tempus augue mollis non. Suspendisse sollicitudin.'];
?>



<div class="container mt-5">
	<div class="row">
		<div class="col-6 p-5 bg-white rounded-2">
			<h4>Task Name</h4>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, saepe repellendus. Quia, a voluptatibus cum asperiores saepe aperiam nemo sit voluptates nostrum vitae debitis aspernatur doloremque optio ratione consequuntur tempore.</p>
			<hr style="visibility:hidden">
			<?= view('pages/viewTask/commentaires', [ 'commentaires' => $arr ]) ?>
			<div class="d-flex justify-content-between mt-5">
				<?= view('components/Button', [ 'text' => "Supprimer", 'type' => 'danger' ]) ?>
				<?= view('components/Button', [ 'text' => "Terminer la tâche", 'type' => null ]) ?>
			</div>
		</div>
		<div class="col-2"></div>
		<div class="col-4 p-5 bg-white rounded-2" style="height: fit-content;">

			<div class="d-flex flex-column gap-4">

				<div>
					<div class="d-flex justify-content-between align-items-center">
						<label class="fs-5 mb-2" for="">Priorité</label>
						<?= view('components/Priority', [ 'nb' => 3]) ?>
					</div>
					<select class="form-select mb-2" name="" id="">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
				</div>


				<?= view('components/Input', [ 'name' => 'date', 'type' => 'date', 'label' => 'Label' ]) ?>

				<div class="d-flex flex-column">
					<div class="d-flex justify-content-between align-items-center">
						<span class="mb-2 fs-5">Est bloqué par :</span>
						<button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#modalAddBlock">
							<?= view('components/Plus') ?>
						</button>
					</div>
					<div class="d-flex flex-wrap gap-2">
						<?= view('components/Tag', [ 'name' => 'Tag 1' ]) ?>
						<?= view('components/Tag', [ 'name' => 'Tag 2' ]) ?>
						<?= view('components/Tag', [ 'name' => 'Tag 3' ]) ?>
						<?= view('components/Tag', [ 'name' => 'Tag 4' ]) ?>
					</div>
				</div>

				<div class="d-flex flex-column">
					<div class="d-flex justify-content-between align-items-center">
						<span class="mb-2 fs-5">Bloque :</span>
						<button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#modalAddIsBlocked">
							<?= view('components/Plus') ?>
						</button>
					</div>
					<div class="d-flex flex-wrap gap-2">
						<?= view('components/Tag', [ 'name' => 'Tag 1' ]) ?>
						<?= view('components/Tag', [ 'name' => 'Tag 2' ]) ?>
						<?= view('components/Tag', [ 'name' => 'Tag 3' ]) ?>
						<?= view('components/Tag', [ 'name' => 'Tag 4' ]) ?>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>

<?= form_close(); ?>

