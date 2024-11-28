<div class="d-flex justify-content-center align-items-center mt-5">
	<div class="rounded shadow p-4 profil mt-5">
		<!-- Onglets -->
		<ul class="nav nav-tabs" id="profilTabs" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">
					Profil
				</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="reglages-tab" data-bs-toggle="tab" data-bs-target="#reglages" type="button" role="tab" aria-controls="reglages" aria-selected="false">
					Réglages
				</button>
			</li>
		</ul>

		<!-- Contenu des onglets -->
		<div class="tab-content mt-4" id="profilTabsContent">
			<!-- Onglet Profil -->
			<div class="tab-pane fade show active" id="profil" role="tabpanel" aria-labelledby="profil-tab">
				<h2 class="mb-4 text-center titleProfil">Mon profil</h2>

				<div class="py-4">
					<!-- Messages flash -->
					<?php if (session()->getFlashdata('error')): ?>
						<div class="alert alert-danger" role="alert">
							<?= session()->getFlashdata('error'); ?>
						</div>
					<?php endif; ?>
					<?php if (session()->getFlashdata('success')): ?>
						<div class="alert alert-success" role="alert">
							<?= session()->getFlashdata('success') ?>
						</div>
					<?php endif; ?>

					<!-- Formulaire de mise à jour du nom -->
					<?= form_open('profil/updateName') ?>
					<div class="mb-3">
						<?= form_label('Nom', 'name', ['class' => 'form-label fw-bold text-secondary']) ?>
						<div class="d-flex">
							<?= form_input([
								'name' => 'name',
								'id' => 'name',
								'type' => 'text',
								'class' => 'form-control rounded',
								'placeholder' => 'Votre nom',
								'value' => isset($name) ? $name : set_value('name'),
								'aria-label' => 'Nom'
							]) ?>
							<div class="ms-2">
								<?= form_submit('submit', '✓', [
									'class' => 'btn btn-success rounded-circle',
									'style' => 'width: 40px; height: 40px;',
									'aria-label' => 'Enregistrer'
								]) ?>
							</div>
						</div>
					</div>
					<?= form_close() ?>

					<!-- Boutons -->
					<div class="mb-3">
						<?= form_button([
							'content' => '<img src="' . base_url('assets/imgs/lock.svg') . '" alt="Mot de passe" class="me-2" style="width: 20px;">Changer le mot de passe',
							'class' => 'btn btn-outline-secondary w-100 rounded-pill',
							'type' => 'button',
							'onclick' => "window.location.href='" . base_url('profil/resetPassword') . "'",
							'aria-label' => 'Changer le mot de passe'
						]) ?>
					</div>
					<div class="mb-3">
						<?= form_button([
							'content' => '<img src="' . base_url('assets/imgs/disconnect.svg') . '" alt="Déconnexion" class="me-2" style="width: 20px;">Déconnexion',
							'class' => 'btn btn-primary w-100 rounded-pill',
							'type' => 'button',
							'onclick' => "window.location.href='" . base_url('profil/logout') . "'",
							'aria-label' => 'Déconnexion'
						]) ?>
					</div>
					<div class="mb-3">
						<?= form_button([
							'content' => '<img src="' . base_url('assets/imgs/bin.svg') . '" alt="Supprimer" class="me-2" style="width: 20px;">Supprimer le compte',
							'class' => 'btn btn-danger w-100 rounded-pill',
							'type' => 'button',
							'onclick' => "if(confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')) window.location.href='" . base_url('profil/deleteAccount') . "'",
							'aria-label' => 'Supprimer le compte'
						]) ?>
					</div>
				</div>
			</div>
							
			<!-- Onglet Réglages -->
			<div class="tab-pane fade" id="reglages" role="tabpanel" aria-labelledby="reglages-tab">
				<h2 class="mb-4 text-center titleProfil">Réglages</h2>

				<?= form_open('profil/updatePreferences', ['preferences' => 'settingsForm']) ?>
				<div class="mb-3">
					<?= form_label('Nombre de jours avant le rappel échéance :', 'days_reminder_deadline', ['class' => 'form-label fw-bold text-secondary']) ?>
					<?= form_input([
						'name' => 'days_reminder_deadline',
						'id' => 'days_reminder_deadline',
						'type' => 'number',
						'class' => 'form-control rounded',
						'placeholder' => 'Entrez un nombre',
						'value' => $preferences['days_reminder_deadline'],
						'min' => 2
					]) ?>
				</div>
				<div class="mb-3">
					<?= form_label('Nombre d\'éléments par page :', 'rows_per_page', ['class' => 'form-label fw-bold text-secondary']) ?>
					<?= form_input([
						'name' => 'rows_per_page',
						'id' => 'rows_per_page',
						'type' => 'number',
						'class' => 'form-control rounded',
						'placeholder' => 'Entrez un nombre',
						'value' => $preferences['rows_per_page'],
						'min' => 2
					]) ?>
				</div>
				<div class="mb-3">
					<?= form_label('Nombre de pages affichées dans la pagination :', 'pagination_pages', ['class' => 'form-label fw-bold text-secondary']) ?>
					<?= form_input([
						'name' => 'pagination_pages',
						'id' => 'pagination_pages',
						'type' => 'number',
						'class' => 'form-control rounded',
						'placeholder' => 'Entrez un nombre',
						'value' => $preferences['pagination_pages'],
						'min' => 2
					]) ?>
				</div>
				<div class="mb-3">
					<?= form_label('Nombre de jours affichés dans le calendrier :', 'displayed_days_in_calendar', ['class' => 'form-label fw-bold text-secondary']) ?>
					<?= form_input([
						'name' => 'displayed_days_in_calendar',
						'id' => 'displayed_days_in_calendar',
						'type' => 'number',
						'class' => 'form-control rounded',
						'placeholder' => 'Entrez un nombre',
						'value' => $preferences['displayed_days_in_calendar'],
						'min' => 2
					]) ?>
				</div>
				<?= form_submit('submit', 'Enregistrer', ['class' => 'btn btn-success w-100 rounded-pill']) ?>
				<?= form_close() ?>
			</div>
		</div>
	</div>
</div>