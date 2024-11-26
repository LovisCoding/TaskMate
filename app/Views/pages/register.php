<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inscription - ScoNotes</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('assets/styles/connection.css'); ?>">
</head>

<body class="d-flex justify-content-center">
	<div class="form-signin w-100 h-100">
		<div class="content">
			<?php if (isset($success)): ?>
				<div class="alert alert-success" role="alert">
					<?= $success; ?>
				</div>
			<?php elseif (isset($error)): ?>
				<div class="alert alert-danger" role="alert">
					<?= $error; ?>
				</div>
			<?php endif; ?>
			<?= form_open('email/sendConfirmAccountMail'); ?>
			<div class="mb-4 mt-4 d-flex flex-column align-items-center">
				<img src="<?= base_url('assets/imgs/Logo_TaskMate.svg'); ?>" alt="Logo TaskMate" width="190" height="120">
				<p class="mb-4 fw-normal">Inscrivez-vous</p>
			</div>

			<div class="mb-3">
				<label class="form-label" for="name">Nom</label>
				<input type="text"
					class="form-control <?= session('validation') && session('validation')->hasError('name') ? 'is-invalid' : '' ?>"
					id="name"
					name="name"
					placeholder="Nom"
					value="<?= old('name') ?>"
					required>
				<?php if (session('validation') && session('validation')->hasError('name')): ?>
					<div class="invalid-feedback">
						<?= session('validation')->getError('name') ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">Email</label>
				<input type="email"
					class="form-control <?= session('validation') && session('validation')->hasError('email') ? 'is-invalid' : '' ?>"
					id="email"
					name="email"
					placeholder="Email"
					value="<?= old('email') ?>"
					required>
				<?php if (session('validation') && session('validation')->hasError('email')): ?>
					<div class="invalid-feedback">
						<?= session('validation')->getError('email') ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="mb-3">
				<label class="form-label" for="password">Mot de passe</label>
				<div class="input-group">
					<input type="password"
						class="form-control <?= session('validation') && session('validation')->hasError('password') ? 'is-invalid' : '' ?>"
						id="password"
						name="password"
						placeholder="Mot de passe"
						required>
					<button type="button" class="btn btn-outline-secondary" id="togglePassword">
						<i class="bi bi-eye-slash" id="passwordIcon"></i>
					</button>
					<?php if (session('validation') && session('validation')->hasError('password')): ?>
						<div class="invalid-feedback">
							<?= session('validation')->getError('password') ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="mb-3">
				<label class="form-label" for="confirm_password">Confirmation du mot de passe</label>
				<div class="input-group">
					<input type="password"
						class="form-control <?= session('validation') && session('validation')->hasError('confirm_password') ? 'is-invalid' : '' ?>"
						id="confirm_password"
						name="confirm_password"
						placeholder="Confirmation du mot de passe"
						required>
					<button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
						<i class="bi bi-eye-slash" id="confirmPasswordIcon"></i>
					</button>
					<?php if (session('validation') && session('validation')->hasError('confirm_password')): ?>
						<div class="invalid-feedback">
							<?= session('validation')->getError('confirm_password') ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<button class="btn btn-primary w-100 btnValidate mt-4" type="submit">S'inscrire</button>
			<p class="form-text mt-3">
				Vous avez déjà un compte ?
				<a href="<?= base_url('/'); ?>">Se connecter</a>
			</p>
			<?= form_close(); ?>

		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('assets/scripts/showPassword.js'); ?>"></script>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>