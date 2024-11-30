<div class="offcanvas offcanvas-end" tabindex="-1" id="filterPanel" aria-labelledby="filterPanelLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="filterPanelLabel">Sélection du tri</h5>
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
                'value' => $filters['end_date'] ?? '',
            ]) ?>
		</div> -->

        <!-- Trie -->
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <?= form_label('', 'sortOption', ['class' => 'form-label me-3']) ?>
            <div class="d-flex align-items-center flex-grow-1">
                <?php
                $sortOptions = [
                    'current_state' => 'État',
                    'deadline' => 'Échéance',
                    'priority' => 'Priorité'
                ];
                ?>

                <?= form_dropdown(
                    'sort', // Nom du champ
                    $sortOptions, // Options disponibles
                    $filters['sort'] ?? 'current_state', // Valeur sélectionnée par défaut
                    [
                        'id' => 'sortOption', // ID du champ
                        'class' => 'form-select flex-grow-1 me-3' // Classe CSS avec espacement
                    ]
                ) ?>
                <!-- Bouton à deux états avec image -->
                <?php
                // Vérifie si l'URL contient "sort_order" et si la valeur est "desc", sinon "asc" par défaut
                $sortOrder = $filters['sortOrder'] ?? 'asc';
                $imageSrc = ($sortOrder === 'desc') ? 'desc.svg' : 'asc.svg';
                ?>

                <!-- Champ caché pour envoyer l'état du tri -->
                <?= form_hidden('sort_order', $sortOrder) ?>

                <!-- Bouton pour alterner asc/desc avec image -->
                <div class="form-check form-switch d-flex align-items-center">
                    <?= form_button([
                        'content' => '<img src="' . base_url('assets/imgs/' . $imageSrc) . '" alt="' . $sortOrder . '" style="width: 20px;">',
                        'class' => 'btn btn-outline-secondary d-flex align-items-center',
                        'id' => 'toggleSortOrder',
                        'type' => 'button'
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="offcanvas-header" style="padding-left: 0;">
            <h5 class="offcanvas-title" id="filterPanelLabel">Sélection des filtres</h5>
        </div>
        <!-- États -->
        <div class="mb-3">
            <?= form_label('Etats:', '', ['class' => 'form-label']) ?>
            <?php
            $stateOptions = [
                'blocked' => 'Bloquée',
                'inProgress' => 'En cours',
                'notStarted' => 'Pas commencée',
                'finished' => 'Terminée'
            ];

            foreach ($stateOptions as $key => $label): ?>
                <div class="form-check d-flex <?= in_array($key, $filters['states']) ? 'checked' : '' ?>">

                    <div class="form-checked <?= !in_array($key, $filters['states']) ? 'd-none' : 'checked' ?>">✓ </div>
                    <?= form_checkbox([
                        'name' => 'states[]',
                        'id' => $key,
                        'value' => $key,
                        'class' => 'd-none pe-auto',
                        'checked' =>  in_array($key, $filters['states'])
                    ]) ?>
                    <?= form_label($label, $key, ['class' => 'form-check-label']) ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Priorités -->
        <div class="mb-3">
            <?= form_label('Priorité:', '', ['class' => 'form-label']) ?>
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