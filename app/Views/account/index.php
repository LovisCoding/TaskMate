<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Exemple de Formulaire CodeIgniter </title>
</head>

<body>
	<h2>Formulaire CodeIgniter </h2>
	<?php echo form_open('/Produit/save'); ?>
	<?php echo form_label('Nom d\'utilisateur:', 'nom'); ?>
	<?php echo form_input('nom', set_value('nom'), 'required'); ?>
	<?= validation_show_error('nom') ?>
	<br>
	<?php echo form_label('Mot de passe:', 'password'); ?>
	<?php echo form_password('password', set_value('password'), 'required'); ?>
	<?= validation_show_error('password') ?>
	<br>
	<?php echo form_label('Re-mot de passe', 'password2'); ?>
	<?php echo form_password('password2', set_value('password2'), 'required'); ?>
	<?= validation_show_error('password2') ?>
	<br>
	<?php echo form_label('Age:', 'age'); ?>
	<?php echo form_input('age', set_value('age'), 'required'); ?>
	<?= validation_show_error('age') ?>
	<br>
	<?php echo form_label('Adresse Email:', 'mail'); ?>
	<?php echo form_input('mail', set_value('mail'), 'required'); ?>
	<?= validation_show_error('mail') ?>
	<br>
	<?php echo form_submit('submit', 'Valider'); ?>
	<?php echo form_close(); ?>
</body>

</html>