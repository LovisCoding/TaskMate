
<div class="viewgroup-content">
    <div class="viewgroup-container">
        <h4>Créer un nouveau groupe</h4>

        <!-- Formulaire -->
        <form action="/newGroup/create" method="post">

            <div class="viewgroup-inputname">
                <label for="group_name">Nom du groupe</label>
                <input type="text" name="group_name" id="group_name" placeholder="Nom du groupe" required>
            </div>

            <div class="viewgroup-list">
                <h4>Ajouter des tâches</h4>
                <div class="viewgroup-listinput">
                    <label>
                        <img src="/assets/imgs/search.svg" width="17px" height="auto">
                    </label>
                    <input type="text" placeholder="Rechercher une tâche" id="search">
                </div>

                <div class="viewgroup-listcontent">
                    <div class="overflow-y-scroll task-checkboxes" id="checkboxes">
                       
                    </div>
                </div>
            </div>

            <!-- Bouton Valider -->
            <button type="submit" class="btn btn-green">
                <strong>Valider le groupe</strong>
            </button>
        </form>
    </div>
</div>
