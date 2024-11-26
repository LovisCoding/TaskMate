<!-- Panneau Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="filterPanel" aria-labelledby="filterPanelLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="filterPanelLabel">Sélection des filtres</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?= form_open('controller/filter', ['id' => 'filterForm']) ?>

        <!-- Date Range -->
        <div class="mb-3">
            <?= form_label('Date de début', 'startDate', ['class' => 'form-label']) ?>
            <?= form_input(['type' => 'date', 'class' => 'form-control', 'id' => 'startDate', 'name' => 'start_date']) ?>
        </div>
        <div class="mb-3">
            <?= form_label('Date de fin', 'endDate', ['class' => 'form-label']) ?>
            <?= form_input(['type' => 'date', 'class' => 'form-control', 'id' => 'endDate', 'name' => 'end_date']) ?>
        </div>

        <!-- Groupes de tâches -->
        <div class="mb-3">
            <?= form_label('Groupes de tâches', 'taskGroups', ['class' => 'form-label']) ?>
            <?= form_dropdown('task_groups', [
                '' => 'Sélectionner des groupes de tâches',
                '1' => 'Groupe 1',
                '2' => 'Groupe 2',
                '3' => 'Groupe 3',
            ], '', ['class' => 'form-select', 'id' => 'taskGroups']) ?>
        </div>

        <!-- États -->
        


		<div class="mb-3">
		<?= form_label('Sélection des états', '', ['class' => 'form-label']) ?>
			<div class="form-check d-flex">
				<div class="form-checked d-none">✓ </div>
				<input class="form-check-input" type="checkbox" value="" id="inProgress" style="display: none;">
				<label role="button" class="form-check-label" for="inProgress">En cours</label>
			</div>
			<div class="form-check d-flex">
				<div class="form-checked d-none">✓ </div>
				<input class="form-check-input" style="display: none;" type="checkbox" value="" id="delayed">
				<label role="button" class="form-check-label" for="delayed">En retard</label>
			</div>
			<div class="form-check d-flex">
				<div class="form-checked d-none">✓ </div>
				<input class="form-check-input" type="checkbox" value="" id="completed" style="display: none;">
				<label role="button" class="form-check-label" for="completed">Terminée</label>
			</div>
			<div class="form-check d-flex">
				<div class="form-checked d-none">✓ </div>
				<input class="form-check-input" type="checkbox" value="" id="blocked" style="display: none;">
				<label role="button" class="form-check-label" for="blocked">Bloquée</label>
			</div>
		</div>
        <!-- Priorités -->
        <div class="mb-3">
            <?= form_label('Sélection des priorités', '', ['class' => 'form-label']) ?>
            <div class="d-flex">
                <?php
                for ($i = 4; $i >= 1; $i--) {
                    echo form_radio(['name' => 'priority', 'id' => "priority$i", 'class' => 'btn-check', 'value' => $i]);
                    echo form_label(
                        "<div class='container'>" . str_repeat("<div class='square'></div>", $i) . "</div>",
                        "priority$i",
                        ['class' => 'btn me-2']
                    );
                }
                ?>
            </div>
        </div>

        <!-- Boutons -->
        <div class="d-flex justify-content-between">
            <?= form_reset('reset', 'Annuler', ['class' => 'btn btn-grey']) ?>
            <?= form_submit('submit', 'Confirmer', ['class' => 'btn btn-grey']) ?>
        </div>

        <?= form_close() ?>
    </div>
</div>
