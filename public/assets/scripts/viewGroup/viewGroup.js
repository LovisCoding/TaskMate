// fetch /api/getTasks

let dataAPI
const list = document.querySelector("#list")

fetch('/api/tasks').then(response => {
    return response.json();
}).then(data => {

    dataAPI = data;
}).catch(err => {
    console.log(err);
});

function setList(results) {


    for (const task of results) {
        // creating a li element for each result item
        const resultItem = document.createElement('li')

        // adding a class to each item of the results
        resultItem.classList.add('result-item')

        // grabbing the name of the current point of the loop and adding the name as the list item's text
        const text = document.createTextNode(task.name)

        // appending the text to the result item
        resultItem.appendChild(text)

        // appending the result item to the list
        list.appendChild(resultItem)
    }
}

const searchInput = document.querySelector("#search")


searchInput.addEventListener("input", (e) => {
    let value = e.target.value

    list.innerHTML = ''
    if (value && value.trim().length > 0) {
        value = value.trim().toLowerCase()

        //returning only the results of setList if the value of the search is included in the person's name
        setList(dataAPI.filter(task => {
            return task.name.toLowerCase().includes(value)
        }))
    }

})