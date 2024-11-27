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
const etats = ['late', 'inProgress', 'notStarted', 'finished', 'blocked'];

etats.forEach(function (etat) {
	document.getElementById(etat).addEventListener('change', function () {
		checkboxEtat(etat);
	});
});

