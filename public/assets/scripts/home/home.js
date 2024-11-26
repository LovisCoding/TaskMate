import openTab from "./tabs.js";
import exportCard from "./export.js";
import filterCard from "./filter.js";
import checkboxEtat from "./checkboxEtat.js";
// tabs.js
document.body.addEventListener('click', function (evt) {
    if (evt.target.classList.contains('tab-link')) openTab(evt, evt.target.id);
}, false);

//export.js
document.getElementById('btn-export').addEventListener('click', function () {
	exportCard();
}, false);

//filter.js

document.getElementById('btn-filter').addEventListener('click', function () {
	filterCard();
}, false );

//checkboxEtat.js
const etats = ['En retard', 'En cours', 'Pas commencée', 'Terminée', 'Bloquée'];

etats.forEach(function (etat) {
	document.getElementById(etat).addEventListener('change', function () {
		checkboxEtat(etat);
	});
});

// reset filter

document.getElementById('resetFilters').addEventListener('click', function () {
	// Récupérer le formulaire
	const form = document.getElementById('filterForm');

	// Réinitialiser tous les champs
	form.reset();

	// Réinitialiser les éléments personnalisés si nécessaire
	document.querySelectorAll('.btn-check').forEach(el => el.checked = false);
	document.querySelectorAll('.form-check-input').forEach(el => el.checked = false);

});