<div class="d-flex justify-content-center mt-5">
	<div class="d-flex flex-column align-items-center rounded shadow p-4 mt-5 profil">
		<h2 class="mb-4 text-center titleProfil">Mon profil</h2>

		<div class="py-4 w-100">
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

			<?= form_open('profil/updateName') ?>

			<!-- Champ Nom -->
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

			<!-- Bouton Changer le mot de passe -->
			<div class="mb-3">
				<?= form_button([
					'content' => '
					<img src="' . base_url('assets/imgs/lock.svg') . '" alt="Mot de passe" class="me-2" style="width: 20px;">
					Changer le mot de passe',
					'class' => 'btn btn-outline-secondary w-100 d-flex justify-content-center align-items-center rounded-pill',
					'type' => 'button',
					'onclick' => "window.location.href='" . base_url('profil/resetPassword') . "'",
					'aria-label' => 'Changer le mot de passe'
				]) ?>
			</div>

			<!-- Bouton Déconnexion -->
			<div class="mb-3">
				<?= form_button([
					'content' => '
					<img src="' . base_url('assets/imgs/disconnect.svg') . '" alt="Déconnexion" class="me-2" style="width: 20px;">
					Déconnexion',
					'class' => 'btn btn-primary w-100 rounded-pill',
					'type' => 'button',
					'onclick' => "window.location.href='" . base_url('profil/logout') . "'",
					'aria-label' => 'Déconnexion'
				]) ?>
			</div>

			<!-- Bouton Supprimer le compte -->
			<div class="mb-3">
				<?= form_button([
					'content' => '
					<img src="' . base_url('assets/imgs/bin.svg') . '" alt="Supprimer" class="me-2" style="width: 20px;">
					Supprimer le compte',
					'class' => 'btn btn-danger w-100 rounded-pill',
					'type' => 'button',
					'onclick' => "if(confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')) window.location.href='" . base_url('profil/deleteAccount') . "'",
					'aria-label' => 'Supprimer le compte'
				]) ?>
			</div>
		</div>
	</div>
</div>
