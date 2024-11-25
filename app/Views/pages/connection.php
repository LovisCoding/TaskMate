<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Connexion - TaskMate</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./assets/styles/connection.css">
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

			<?= form_open('auth/login'); ?>
			<div class="mb-4 mt-4 d-flex flex-column align-items-center">
				<img class="mb-4" src="./assets/imgs/Logo_TaskMate.svg" alt="Logo TaskMate" width="190" height="120">
				<p class="mb-4 fw-normal">Connectez-vous à votre compte</p>
			</div>
			<div class="mb-3">
				<label class="form-label" for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
				<div id="emailError" class="invalid-feedback"></div>
			</div>
			<div class="mb-3">
				<label class="form-label" for="password">Mot de passe</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
				<div id="pwError" class="invalid-feedback"></div>
			</div>
			<button class="btn btn-primary w-100 btnValidate mt-4" type="submit">Se connecter</button>
			<p class="form-text mt-3">Mot de passe oublié ?
				<a href="<?= base_url('/'); ?>">Réinitialisation</a>
			</p>
			<p class="form-text mt-3">Pas encore de compte ?
				<a href="<?= base_url('auth/register'); ?>">S'inscrire</a>
				<?= form_close(); ?>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>