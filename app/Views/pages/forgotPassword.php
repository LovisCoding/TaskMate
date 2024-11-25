<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réinitialisation du mot de passe - ScoNotes</title>
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
			<form action="/forgot-password/sendResetLink" method="post">
				<?= csrf_field() ?>
				<div class="form-group mb-3">
				<label for="email">Adresse e-mail :</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre e-mail" required>
				</div>
				<button type="submit" class="btn btn-primary w-100 form-text">Envoyer le lien de réinitialisation</button>
			</form>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>