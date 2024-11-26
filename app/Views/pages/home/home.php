<?php

include __DIR__.'/../../components/Filter.php';
include __DIR__.'/../../components/Export.php';
include __DIR__.'/../../components/NewTache.php';
include __DIR__.'/../../components/CalendarRange.php';
include __DIR__.'/../../components/CalendarItemTitle.php';
include __DIR__.'/../../components/Card.php';
include __DIR__.'/../../components/Tabs.php';

?>

<div>
	<div class="pt-4"></div>
	<div class="d-flex justify-content-between mx-4" id="vues">
		<div class="left d-flex">
			<?= tabs() ?>
			<?= export() ?>
			<?= filter() ?>
		</div>
		<div class="right">
			<?= newTache() ?>
		</div>
	</div>
</div>

<div class="d-flex justify-content-center mt-4">
	<?= CalendarRange((new DateTime())->modify('-7 days'), 5) ?>
</div>

<div class="container mt-4">
    <div class="row">
        <?php foreach ($tasks as $dateString => $taskes): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <?php
                    $date = new DateTime($dateString);
                ?>
                <?= CalendarItemTitle($date) ?>

                <?php foreach ($taskes as $task): ?>
                    <div class="mb-3 mt-3">
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
