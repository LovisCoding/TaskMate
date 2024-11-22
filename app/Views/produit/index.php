<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Exemple de Formulaire CodeIgniter </title>
</head>

<body>
	<h2>Formulaire CodeIgniter </h2>
	<?php echo form_open('/Produit/save'); ?>
	<?php echo form_label('Nom', 'nom'); ?>
	<?php echo form_input('nom', set_value('nom'), 'required'); ?>
	<?= validation_show_error('nom') ?>
	<br>
	<?php echo form_label('Catégorie', 'categ'); ?>
	<?php echo form_input('categ', set_value('categ'), 'required'); ?>
	<?= validation_show_error('categ') ?>
	<br>
	<?php echo form_label('Prix', 'prix'); ?>
	<?php echo form_input('prix', set_value('prix'), 'required'); ?>
	<?= validation_show_error('prix') ?>
	<br>
	<?php echo form_submit('submit', 'Valider'); ?>
	<?php echo form_close(); ?>
</body>

</html>