
import exportCard from "./export.js";
import filterCard from "./filter.js";
import checkboxEtat from "./checkboxEtat.js";
import sortOrder from "./sortOrder.js";

//export.js
document.getElementById('btn-export').addEventListener('click', function () {
	// exportCard();
    console.log("export");
}, false);

//filter.js

document.getElementById('btn-filter').addEventListener('click', function () {
	filterCard();
}, false);

//checkboxEtat.js
const etats = ['late', 'inProgress', 'notStarted', 'finished', 'blocked'];

etats.forEach(function (etat) {
	document.getElementById(etat).addEventListener('change', function () {
		checkboxEtat(etat);
	});
});

// sortOrder.js
document.getElementById('toggleSortOrder').addEventListener('click', function (button) {
	sortOrder();
}, false);



// unselect radio button filter

let lastSelected = null;

document.querySelectorAll('input[name="priority"]').forEach(radio => {
	if (radio.checked) lastSelected = radio;
	radio.addEventListener('click', function (event) {
		// Si ce bouton était déjà sélectionné
		if (lastSelected === this) {
			this.checked = false; // Désélectionner
			lastSelected = null; // Réinitialiser le dernier bouton sélectionné
		} else {
			lastSelected = this; // Mettre à jour le dernier bouton sélectionné
		}
	});
});


// button new tache

document.getElementById('btn-new-tache').addEventListener('click', function () {
	window.location.href = '/task/insert/';
}, false);