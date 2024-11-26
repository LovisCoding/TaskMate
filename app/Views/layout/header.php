<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TaskMate</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="assets/styles/nav.css" rel="stylesheet"/>
	<link href="assets/styles/components.css" rel="stylesheet"/>
	<?=str_starts_with($_SERVER['REQUEST_URI'], '/home') ?  '<link href="assets/styles/home.css" rel="stylesheet"/>': '' ?>
	
</head>
<body class="bg-body-tertiary">

