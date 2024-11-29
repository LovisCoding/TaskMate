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
			
			<?php echo form_open('/forgot-password/updatePassword', ['method' => 'post']); ?>
				<?= csrf_field() ?>
				<input type="hidden" name="token" value="<?= esc($token) ?>">

				<div class="form-group">
					<label for="password" class="form-label">Nouveau mot de passe :</label>
					<?php
						$passwordValue = old('password') ?: '';
						$passwordClass = session('validation') && session('validation')->hasError('password') ? 'is-invalid' : '';
					?>
					<input type="password" class="form-control <?= $passwordClass ?>" id="password" name="password" placeholder="Entrez un nouveau mot de passe" value="<?= esc($passwordValue) ?>" required>
					<?php if (session('validation') && session('validation')->hasError('password')): ?>
						<div class="invalid-feedback">
							<?= session('validation')->getError('password') ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="form-group">
					<label for="confirm_password" class="form-label">Confirmez le mot de passe :</label>
					<?php
						$confirmPasswordValue = old('confirm_password') ?: '';
						$confirmPasswordClass = session('validation') && session('validation')->hasError('confirm_password') ? 'is-invalid' : '';
					?>
					<input type="password" class="form-control <?= $confirmPasswordClass ?>" id="confirm_password" name="confirm_password" placeholder="Confirmez le mot de passe" value="<?= esc($confirmPasswordValue) ?>" required>
					<?php if (session('validation') && session('validation')->hasError('confirm_password')): ?>
						<div class="invalid-feedback">
							<?= session('validation')->getError('confirm_password') ?>
						</div>
					<?php endif; ?>
				</div>

				<button type="submit" class="btn btn-primary w-100 form-text mt-3">Confirmer</button>
			<?php echo form_close(); ?>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
