import { openTab } from "./tabs.js";
console.log('icic')
// tabs.js
document.body.addEventListener('click', function (evt) {
    if (evt.target.classList.contains('tab-link')) openTab(evt, evt.target.id);
}, false);

//export.js

