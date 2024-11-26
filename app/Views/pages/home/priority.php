
<div>
	<div class="pt-4"></div>
	<div class="d-flex justify-content-between mx-4" id="vues">
		<div class="left d-flex">
			<?= view('components/Tabs') ?>
			<?= view('components/Export') ?>
			<?= view('components/Filter') ?>
		</div>
		<div class="right">
			<?= view('components/NewTache') ?>
		</div>
	</div>
</div>

<?php 

if ( !isset($date) ){
	$date = new DateTime();
	$date->modify('-7 days');
} 

?>

<div class="d-flex justify-content-center mt-4">
	<?= view('components/CalendarRange', [ 'date' => $date, 'nb' => 3]) ?>
</div>

<div class="container mt-4">
	<div class="d-flex justify-content-between">
		<?php foreach ($tasks as $dateString => $taskes): ?>
			<div>
				<?php
					$date = new DateTime($dateString);
				?>
				<?= view('components/CalendarItemTitle', [ 'date' => $date]) ?>
				
				<?php foreach ($taskes as $task): ?>
					<div class="mb-3 mt-3">
						<?= generateCard(
							htmlspecialchars($task[0]),
							htmlspecialchars($task[1]),
							htmlspecialchars($task[2]),
							htmlspecialchars($task[3])
						) ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>