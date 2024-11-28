<h1>Récapitulatif des tâches en retard</h1>

<?php foreach ($data as $line_date => $tasks) { ?>
	<h2><?= $line_date ?></h2>
	<ul>
		<?php foreach ($tasks as $task) { ?>
			<li><?= $task ?></li>
		<?php } ?>
	</ul>
<?php } ?>