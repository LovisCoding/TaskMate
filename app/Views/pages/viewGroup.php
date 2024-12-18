<div class="viewgroup-content">
    <div class="container mt-3">
        <h4 class="text-center">Gestion des groupes</h4>
        <div class="row g-4">
            <div class="col-md-6 bg-white rounded p-3">
                <h5 class="text-center mb-4">Création d'un groupe</h5>
                <form action="/newGroup/create" method="post">
                    <div class="viewgroup-inputname mb-3">
                        <label for="group_name">Nom du groupe</label>
                        <input type="text" maxlength="50" name="group_name" id="group_name" class="form-control" placeholder="Nom du groupe" required>
                    </div>

                    <div class="viewgroup-list mb-3">
                        <h4>Ajouter des tâches</h4>
                        <div class="viewgroup-listinput input-group">
                            <span class="input-group-text group-svginput">
                                <img src="/assets/imgs/search.svg" width="17px" height="auto">
                            </span>
                            <input type="text" class="form-control" placeholder="Rechercher une tâche" id="search">
                        </div>

                        <div class="viewgroup-listcontent mt-2">
                            <div class="overflow-y-scroll task-checkboxes" id="checkboxes">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-success">
                            <strong>Valider le groupe</strong>
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-md-6 bg-white rounded p-3">
                <h5 class="text-center mb-4">Suppression d'un groupe</h5>
                <form action="/newGroup/delete" method="post">
                    <div class="viewgroup-right-panel">
                        <div class="mb-3">
                            <label for="group_select">Sélectionner des groupes</label>
                            <div class="listGroup">
                                <?php
                                foreach ($groups as $group) : ?>
                                    <div class="mb-2">
                                        <label class="input-group-text">
                                            <input class="form-check-input me-2" name="groups[]" type="checkbox" value="<?= $group['id'] ?>" id="<?= $group['id']  ?>">
                                            <?= $group['name']  ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer la sélection">
                                <i class="bi bi-x-circle"></i> Supprimer
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>