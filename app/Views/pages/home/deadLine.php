<?php
include __DIR__.'/../../components/Card.php'
?>

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

$date = new DateTime($date);

?>

<div class="d-flex justify-content-center mt-4">
	<?= view('components/CalendarRange', [ 'date' => $date, 'nb' => $nb]) ?>
</div>

<div class="container mt-4">
	<div class="d-flex flex-wrap align-items-start justify-content-center">
		<?php foreach ($tasks as $dateString => $taskes): ?>
			<div class="d-flex flex-column me-4 mb-4">
				<?php
					$date = new DateTime($dateString);
				?>
				<div class="mb-3">
					<?= view('components/CalendarItemTitle', [ 'date' => $date]) ?>
				</div>
				<?php foreach ($taskes as $task): ?>
					<div class="mb-3">
						<?= generateCard(
							htmlspecialchars($task['name']),
							htmlspecialchars($task['description']),
							htmlspecialchars($task['priority']),
							htmlspecialchars($task['current_state'])
						) ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?=view('pages/home/filterPanel')?>