<?php
include __DIR__ . '/../components/button.php';
include __DIR__ . '/../components/Input.php';
?>
<div class="w-100 d-flex justify-content-center pt-4">
	<div class="d-flex flex-column align-items-center" style="width: 300px;">
		<div class="py-4 w-100">
			<?= Input('Nom', 'Nom', 'nom', 'text') ?>
			<div class="pt-4"></div>
			<?= Input('Email', 'Email', 'email', 'text') ?>
			<div class="pt-4"></div>
			<?= button(null, 'Changer le mot de passe', 'btn-reset-password') ?>
			<div class="pt-4"></div>
			<?= button(null, 'Déconnexion', 'btn-deconnexion', 'marron') ?>
			<div class="pt-4"></div>
			<div class="pt-4"></div>
			<?= button(null, 'Supprimer le compte', 'btn-sup-compte', 'danger') ?>
		</div>


	</div>
</div>