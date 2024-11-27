<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réinitialisation du mot de passe - TaskMate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/styles/connection.css'); ?>">
</head>
<body class="d-flex justify-content-center">
	<div class="form-signin w-100 h-100">
		<div class="content">
			<div class="mb-4 mt-4 d-flex flex-column align-items-center">
				<img src="<?= base_url('assets/imgs/Logo_TaskMate.svg'); ?>" alt="Logo TaskMate" width="190" height="120">
				<p class="mb-4 mt-4">Réinitialisez votre mot de passe</p>
			</div>
			<?php if (session()->getFlashdata('error')): ?>
				<div class="alert alert-danger">
					<?= session()->getFlashdata('error') ?>
				</div>
			<?php endif; ?>
			<?php if (session()->getFlashdata('success')): ?>
				<div class="alert alert-success">
					<?= session()->getFlashdata('success') ?>
				</div>
			<?php endif; ?>
			<?= form_open('forgot-password/sendResetLink'); ?>
				<?= csrf_field(); ?>
				<div class="form-group mb-3">
					<label for="email" class="form-label">Adresse e-mail :</label>
					<?= form_input([
						'type' => 'email',
						'class' => 'form-control',
						'id' => 'email',
						'name' => 'email',
						'placeholder' => 'Entrez votre e-mail',
						'required' => 'required'
					]); ?>
				</div>

				<?= form_submit('submit', 'Envoyer le lien de réinitialisation', ['class' => 'btn btn-primary w-100 form-text']); ?>
			<?= form_close(); ?>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>