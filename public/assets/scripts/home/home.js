import openTab from "./tabs.js";
import exportCard from "./export.js";
import filterCard from "./filter.js";
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