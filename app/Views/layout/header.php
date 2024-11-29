<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TaskMate</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="<?= base_url('assets/styles/nav.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/styles/components.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/styles/concentration.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/styles/view-group.css'); ?>">

	<?=str_contains($_SERVER['REQUEST_URI'], '/home') ?  '<link href="'.base_url('assets/styles/home.css').'" rel="stylesheet"/>': '' ?>

	<script src="/assets/scripts/Init.js"></script>
	
</head>
<body class="bg-body-tertiary">

