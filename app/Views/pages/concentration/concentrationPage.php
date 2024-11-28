<form action="/concentration/validate" method="GET">



	<div class="concentration-page mb-5">
		<div class="concentration-section ms-2">

			<div class="concentration-section-task">

				<h2>
					<?= $data['title'] ?>
				</h2>

				<div class="concentration-description mb-2">
					<?= $data['description'] ?>
					Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil, quibusdam laboriosam amet necessitatibus fuga consequuntur consequatur explicabo dignissimos enim ab. Mollitia ullam facere assumenda animi error ut voluptatibus rem soluta.
				</div>

				<div class="container text-center">
					<div class="mb-2">
						<span id="timerDisplay" class="fs-1">
							<input type="number" id="timerInputMinutes" class="fs-1 form-control mx-auto d-inline no-spinner" min="0" max="59" value="00" />
							:
							<input type="number" id="timerInputSeconds" class="fs-1 form-control mx-auto d-inline no-spinner" min="0" max="59" value="00" />
						</span>
					</div>
					<div>
						<div id="startPauseButton" class="btn btn-success">Démarrer</div>
						<div id="resetTimerButton" class="btn btn-secondary">Effacer</div>
					</div>
				</div>

			</div>
			<div class="concentration-section-button mt-3">
				<button type="submit" class="btn btn-secondary">Ignorer la tâche</button>
				<button type="submit" class="btn btn-primary">Terminer la tâche</button>
			</div>
		</div>


		<?= view('pages/concentration/concentrationCommentaries', ['commentaries' => $data['commentaires'], 'pager' => $data['pager']]) ?>
	</div>

</form>