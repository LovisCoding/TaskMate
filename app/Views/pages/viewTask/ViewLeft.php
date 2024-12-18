<div class="shadow col-sm-12 col-lg-6 p-5 bg-white rounded-2">
    <?= view('components/Input', ['name' => 'task_name', 'label' => null, 'type' => 'text', 'placeholder' => 'Titre de la tâche', 'value' => $title, 'maxlength' => 50, 'required' => true]) ?>
    <textarea name="task_desc" class="form-control mb-3 mt-3" placeholder="Description"
        rows="5" required><?= $description ?></textarea>
    
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"  <?= $disabled ? 'disabled' : '' ?> name="taskIsStarted" <?= $isChecked ? 'checked' : '' ?> >
        <label class="form-check-label" for="flexSwitchCheckDefault">Tâche commencée</label>
    </div>
    <div class="py-3"></div>
    <?= view('pages/viewTask/Commentaries', ['commentaires' => $commentaries, 'pager' => $pager]) ?>
</div>
