<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Exemple de Formulaire CodeIgniter </title>
</head>

<body>
	<h2>Formulaire CodeIgniter </h2>
	<?php echo form_open('FormControleur/traitement'); ?>
	<?php echo form_label('Nom Utilisateur', 'identifiant'); ?>
	<?php echo form_input('identifiant', set_value('identifiant'), 'required'); ?>
	<?= validation_show_error('identifiant') ?>
	<br>
	<?php echo form_label('Adresse e-mail', 'email'); ?>
	<?php echo form_input('email', set_value('email'), 'required'); ?>
	<?= validation_show_error('email') ?>
	<br>
	<?php echo form_submit('submit', 'Envoyer'); ?>
	<?php echo form_close(); ?>
</body>

</html>