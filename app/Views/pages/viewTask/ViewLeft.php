<?php
$arr = [
	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus, purus at fermentum pulvinar, dolor nibh auctor odio, vel consequat purus justo et dolor. Curabitur facilisis tortor velit, sit amet tempus augue mollis non. Suspendisse sollicitudin.',
	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus, purus at fermentum pulvinar, dolor nibh auctor odio, vel consequat purus justo et dolor. Curabitur facilisis tortor velit, sit amet tempus augue mollis non. Suspendisse sollicitudin.',
	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In rhoncus, purus at fermentum pulvinar, dolor nibh auctor odio, vel consequat purus justo et dolor. Curabitur facilisis tortor velit, sit amet tempus augue mollis non. Suspendisse sollicitudin.'
];
?>

<div class="col-sm-12 col-lg-6 p-5 bg-white rounded-2">
    <?= view('components/Input', ['name' => 'task_name', 'label' => null, 'type' => 'text', 'placeholder' => '', 'value' => $title]) ?>
    <textarea name="task_desc" class="form-control mb-3 mt-3" placeholder="Description"
        rows="5"> <?= $description ?> </textarea>
    
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="taskIsStarted" <?= $isChecked ? 'checked' : '' ?>>
        <label class="form-check-label" for="flexSwitchCheckDefault">Tâche commencée</label>
    </div>
    <div class="py-3"></div>
    <?= view('pages/viewTask/Commentaries', ['commentaires' => $commentaries, 'pager' => $pager]) ?>
</div>