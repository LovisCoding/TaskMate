export default function (id) {

const checkbox = document.getElementById(id);
const parent = checkbox.parentNode;
const validate = parent.children[0];

console.log(checkbox, parent, validate);

 if (checkbox.checked) {
	 validate.classList.remove('d-none');
	 parent.classList.add('checked')
 } else {
	 validate.classList.add('d-none');
	 parent.classList.remove('checked')
 }
}

