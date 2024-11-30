<div class="concentration-page mb-5">


	<div class="concentration-section ms-2">

		<form id="newGroup" method="POST" action='concentration/group'>
			<div class="d-flex justify-content-center" style="margin-bottom:5px">
					<?php $groupId = $data["groupId"] ?>
						<select id="taskGroup" name="task_group" class="form-select" style="width:fit-content;">
							<option value="" <?= empty($groupId) ? 'selected' : '' ?>>Aucun groupe</option>
							<?php foreach ($data['groups'] as $group): ?>
								<option value="<?= $group['id'] ?>" <?= (!empty($groupId) && $groupId == $group['id']) ? 'selected' : '' ?>>
									<?= esc($group['name']) ?>
								</option>
							<?php endforeach; ?>
						</select>
						<div class="ms-2">
								<button type="submit" name="action" value="newConcentration" class="btn btn-success rounded-circle" form="newGroup" title="Démarrer une nouvelle session uniquement avec ce groupe">✓</button>
						</div>
			</div>
		</form>


		<form id="submitForm" action="/concentration/validate" method="POST">

			<div class="concentration-section-task shadow">

				

				<div class="d-flex flex-column mb-1 gap-2">

					<h2 class="d-flex align-items-center justify-content-center">
						<?= $data['title'] ?>
					</h2>

					<div class="container text-center">
						<span id="timerDisplay" class="fs-1 mb-2">
							<input type="number" id="timerInputMinutes" class="fs-1 form-control mx-auto d-inline no-spinner" min="0" max="59" value="00" />
							:
							<input type="number" id="timerInputSeconds" class="fs-1 form-control mx-auto d-inline no-spinner" min="0" max="59" value="00" />
						</span>
						<div class="d-flex gap-1 justify-content-center">
							<div id="startPauseButton" style="width:6rem;" class="btn btn-success">Démarrer</div>
							<div id="resetTimerButton" style="width:6rem;" class="btn btn-secondary">Effacer</div>
						</div>

					</div>


				</div>


				<div class="concentration-description">
					<?= $data['description'] ?>
				</div>


			</div>
			<div class="concentration-section-buttons mt-3">
				<button type="submit" name="action" value="ignore" class="btn btn-secondary" form="submitForm">Ignorer la tâche</button>
				<button type="submit" name="action" value="complete" class="btn btn-primary" form="submitForm">Terminer la tâche</button>
			</div>
		</form>

	</div>

	<?= view('pages/concentration/concentrationCommentaries', ['commentaries' => $data['commentaires'], 'pager' => $data['pager']]) ?>
</div>