<div class="offcanvas offcanvas-end" tabindex="-1" id="filterPanel" aria-labelledby="filterPanelLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="filterPanelLabel">Sélection des filtres</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?= form_open(current_url() . '?' . http_build_query($queryParams), ['method' => 'get', 'id' => 'filterForm']) ?>
        <?= form_hidden('date', (string) ($filters['start_date'] ?? '')) ?>
        <?= form_hidden('nb', (string) ($nb ?? 7)) ?>
        <!-- Date Range -->
        <!-- <div class="mb-3">
			<?= form_label('Date de début', 'startDate', ['class' => 'form-label']) ?>
			<?= form_input([
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'startDate',
                'name' => 'start_date',
                'value' => $filters['start_date'] ?? ''
            ]) ?>
		</div>
		<div class="mb-3">
			<?= form_label('Date de fin', 'endDate', ['class' => 'form-label']) ?>
			<?= form_input([
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'endDate',
                'name' => 'end_date',
                'value' => $filters['end_date'] ?? ''
            ]) ?>
		</div> -->

        <!-- États -->
        <div class="mb-3">
            <?= form_label('Sélection des états', '', ['class' => 'form-label']) ?>
            <?php
            $stateOptions = [
                'late' => 'En retard',
                'inProgress' => 'En cours',
                'notStarted' => 'Pas commencée',
                'finished' => 'Terminée',
                'blocked' => 'Bloquée'
            ];

            foreach ($stateOptions as $key => $label): ?>
                <div class="form-check d-flex <?= in_array($key, $filters['states']) ? 'checked' : '' ?>">

                    <div class="form-checked <?= !in_array($key, $filters['states']) ? 'd-none' : 'checked' ?>">✓ </div>
                    <?= form_checkbox([
                        'name' => 'states[]',
                        'id' => $key,
                        'value' => $key,
                        'class' => 'd-none pe-auto'
                    ]) ?>
                    <?= form_label($label, $key, ['class' => 'form-check-label']) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Priorités -->
        <div class="mb-3">
            <?= form_label('Sélection des priorités', '', ['class' => 'form-label']) ?>
            <div class="d-flex">
                <?php
                for ($i = 4; $i >= 1; $i--) {
                    echo form_radio([
                        'name' => 'priority',
                        'id' => "priority$i",
                        'class' => 'btn-check',
                        'value' => $i,
                        'checked' => ($filters['priority'] ?? null) == $i
                    ]);
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
        <div class="d-flex justify-content-center">
            <?= form_submit('', 'Confirmer', ['class' => 'btn btn-grey']) ?>
        </div>

        <?= form_close() ?>

    </div>
</div>