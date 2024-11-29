// fetch /api/getTasks

let dataAPI
const list = document.querySelector("#checkboxes")

fetch('/api/tasks').then(response => {
    return response.json();
}).then(data => {

    dataAPI = data;
	setList(dataAPI)
}).catch(err => {
    console.log(err);
});



const searchInput = document.querySelector("#search")


searchInput.addEventListener("input", (e) => {
    let value = e.target.value

    list.innerHTML = ''
        value = value.trim().toLowerCase()

        //returning only the results of setList if the value of the search is included in the person's name

		const filter = dataAPI.filter(task => {
            return task.name.toLowerCase().includes(value) || task.isChecked
        })
		const ordered = filter.sort((a, b) => {
			if (a.isChecked && !b.isChecked) return -1;
			if (!a.isChecked && b.isChecked) return 1;
			return 0;
		});
        setList(ordered)
    

})

function setList(results) {
	const name = "task[]";

    for (const task of results) {

	// Create the input group container
	const inputGroup = document.createElement("div");
	inputGroup.className = "input-group mb-2";
  
	// Create the input group text container
	const inputGroupText = document.createElement("div");
	inputGroupText.className = "input-group-text w-100 overflow-hidden";
	inputGroupText.style.fontSize = "0.8rem";
  
	// Create the checkbox input
	const checkbox = document.createElement("input");
	checkbox.type = "checkbox";
	checkbox.className = "form-check-input mt-0";
	checkbox.checked = task.isChecked;
	checkbox.value = task.id_task;
	checkbox.name = name;
	checkbox.id = `${name}${task.id_task}`;
  
	
	// Create the label
	const label = document.createElement("label");
	label.className = "ms-3";
	label.setAttribute("for", `${name}${task.id}`);
	label.style.textOverflow = "ellipsis";
	label.style.overflow = "hidden";
	label.textContent = task.name;
  
	// Append elements to build the structure
	inputGroupText.appendChild(checkbox);
	inputGroupText.appendChild(label);
	inputGroup.appendChild(inputGroupText);
	list.appendChild(inputGroup);

	checkbox.addEventListener("change", (event) => {
		const i = dataAPI.findIndex(t => t.id_task == event.target.value);
		dataAPI[i].isChecked = event.target.checked;
	});
    }
}

