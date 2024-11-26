<div class="w-100 d-flex justify-content-center pt-4">
	<div class="d-flex flex-column align-items-center" style="width: 300px;">
		<div class="py-4 w-100">
			<?php if (session()->getFlashdata('error')): ?>
				<div class="alert alert-danger" role="alert">
					<?= session()->getFlashdata('error'); ?>
				</div>
			<?php endif; ?>
			<?php if (session()->getFlashdata('success')): ?>
				<div class="alert alert-success">
					<?= session()->getFlashdata('success') ?>
				</div>
			<?php endif; ?>

			<?= form_open('profil/updateName') ?> <!-- Action vers la méthode de mise à jour -->

			<!-- Champ Nom -->
			<div class="mb-3">
				<?= form_label('Nom', 'name', ['class' => 'form-label']) ?>
				<?= form_input([
					'name' => 'name',
					'id' => 'name',
					'type' => 'text',
					'class' => 'form-control',
					'placeholder' => 'Nom',
					'value' => isset($name) ? $name : set_value('name')
				]) ?>
			</div>

			<!-- Bouton Valider les modifications -->
			<div class="mb-3">
				<?= form_submit('submit', 'Valider le changement de nom', [
					'class' => 'btn btn-success w-100'
				]) ?>
			</div>

			<?= form_close() ?> <!-- Fin du formulaire -->

			<!-- Bouton Changer le mot de passe -->
			<div class="mb-3">
				<?= form_button([
					'content' => 'Changer le mot de passe',
					'class' => 'btn btn-primary w-100',
					'type' => 'button',
					'onclick' => "window.location.href='" . base_url('profil/resetPassword') . "'"
				]) ?>
			</div>

			<!-- Bouton Déconnexion -->
			<div class="mb-3">
				<?= form_button([
					'content' => 'Déconnexion',
					'class' => 'btn btn-warning w-100',
					'type' => 'button',
					'onclick' => "window.location.href='" . base_url('profil/logout') . "'"
				]) ?>
			</div>

			<!-- Bouton Supprimer le compte -->
			<div class="mb-3">
				<?= form_button([
					'content' => 'Supprimer le compte',
					'class' => 'btn btn-danger w-100',
					'type' => 'button',
					'onclick' => "if(confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')) window.location.href='" . base_url('profil/deleteAccount') . "'"
				]) ?>
			</div>
		</div>
	</div>
</div>