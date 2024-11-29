

<?php

$taskList = [
    [
        'id' => 1,
        'name' => 'Faire les courses',
        'isChecked' => false,
    ],
    [
        'id' => 2,
        'name' => 'Terminer le rapport',
        'isChecked' => true,
    ],
    [
        'id' => 3,
        'name' => 'Appeler le client',
        'isChecked' => false,
    ],
    [
        'id' => 4,
        'name' => 'Préparer la réunion',
        'isChecked' => true,
    ],
    [
        'id' => 5,
        'name' => 'Nettoyer le bureau',
        'isChecked' => false,
    ],
    [
        'id' => 5,
        'name' => 'Nettoyer le bureau',
        'isChecked' => false,
    ],
    [
        'id' => 5,
        'name' => 'Nettoyer le bureau',
        'isChecked' => false,
    ],
    [
        'id' => 5,
        'name' => 'Nettoyer le bureau',
        'isChecked' => false,
    ],
    [
        'id' => 5,
        'name' => 'Nettoyer le bureau',
        'isChecked' => false,
    ],
    [
        'id' => 5,
        'name' => 'Nettoyer le bureau',
        'isChecked' => false,
    ],
    [
        'id' => 5,
        'name' => 'Nettoyer le bureau',
        'isChecked' => false,
    ],
];

$name = 'task_list';
?>

<div class="viewgroup-content">

    <div class="viewgroup-container">

        <h4>
            Créer un nouveau groupe
        </h4>

        <div class="viewgroup-inputname" >
        <?= view('components/Input', ['name' => 'group_name', 'label' => null, 'type' => 'text', 'placeholder' => 'Nom du groupe', 'value' => '']) ?>
        </div>

        <div class="viewgroup-list" >
            <div class="viewgroup-listinput">
                <label style="margin:0;padding:0;"><img src="/assets/imgs/search.svg" width="17px" height="auto" style="margin:0;padding:0;" /></label>
                <input type="text" placeholder="Rechercher une tâche" id="search" />
            </div>

            <div class="viewgroup-listcontent" >
                <!-- 

Paramètres

taskList
	- id
	- name

-->
<h4>
           Ajouter des tâches
        </h4>

<div class="overflow-y-scroll task-checkboxes" id="checkboxes">


</div>


            </div>

        </div>

    </div>

    <?= view('components/Button', ['text' => "<strong>Valider le groupe</strong>", 'type' => 'green', 'name' => 'action', 'value' => 'complete', 'disabled' => false, 'svgName' => 'check']) ?>


</div>
