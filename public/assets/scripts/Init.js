/* class Commentaries {

	elements = [];

	elementsPerPage = 2;
	currentPage = 0;

	push(content) {
		let element = document.createElement('textarea');
		element.name = "task_commentaries[]";
		element.className = "form-control commentaire mb-3";
		element.rows = 3;
		element.textContent = content;
		element.addEventListener('change', () => {
			if (element.value == '') elements.delete(element);
			else element.textContent = element.value
		})
		this.elements = [element, ...this.elements];
		this.switchPage(0);
	}

	nextAvailable() {
		if (this.currentPage + 1 * this.elementsPerPage > this.elements.length - 1) return false;
		return true;
	}

	previousAvailable() {
		if (this.currentPage == 0) return false;
		return true;
	}

	switchPage(numPage) {
		this.currentPage = numPage;
		this.getList();
		this.getPagination();
	}

	getList() {
		let mainDiv = document.getElementById('ListCommentaries');
		console.log(mainDiv);
		let div = document.createElement('div');
		div.id = "ListCommentaries";
		let start = this.currentPage * this.elementsPerPage;
		for (let i = 0; i < this.elementsPerPage; i++) {
			if (!this.elements[start + i]) break;
			div.append(this.elements[start + i]);
		}
		mainDiv.replaceWith(div);
	}

	getPagination() {
		let mainDiv = document.getElementById('Pagination');
		console.log(mainDiv)
		let div = document.createElement('div');
		div.id = "Pagination";
		div.classList = "pagination";
		console.log(this.previousAvailable());
		console.log(this.nextAvailable());
		if (this.previousAvailable()) {
			let previous = document.createElement('li')
			previous.className = "page-item page-link";
			previous.textContent = "Précédent";
			previous.addEventListener('click', () => {
				this.switchPage(this.currentPage - 1);
			})
			div.appendChild(previous);
		}

		let nbTotalPage = this.elements.length / this.elementsPerPage;

		for (let i = 0; i < nbTotalPage; i++) {
			let el = document.createElement('li');
			el.className = "page-item page-link";
			el.textContent = i;
			el.addEventListener('click', () => {
				this.switchPage(i);
			})
			div.appendChild(el);
		}

		if (this.nextAvailable()) {
			let next = document.createElement('li')
			next.className = "page-item page-link";
			next.textContent = "Suivant";
			next.addEventListener('click', () => {
				this.switchPage(this.currentPage + 1);
			})
			div.appendChild(next);
		}
		mainDiv.replaceWith(div);
	}

}

let ObjCommentaries = new Commentaries();

let commentaryList;
let commentariesNodes = [];
let nbElement = 2;
let nbPage = 0;
let pagination;

function pushCommentary(node){
	commentariesNodes = [node, ...commentariesNodes];
	nbPage = 0;
}

function changePage(action) {
	if (action == 'next') {
		if ( commentariesNodes.length-1 > nbPage+1 * nbElement ) nbPage++;
	}
	else if (action == 'previous') {
		if ( nbPage-1 >= 0 ) nbPage--;
	}
	console.log(nbPage);
	console.log(nbElement);
	fetchCommentaryPage(nbPage, nbElement)
}

function fetchCommentaryPage(page, nb){
	pagination = document.getElementById('pagination');
	commentaryList = document.getElementById('commentaryList');
	commentaryList.innerHTML = "";
	pagination.setAttribute('page', page);
	let start = page * nb;
	for (let i = 0; i < nb; i++) {
		commentaryList.appendChild(commentariesNodes[start + i]);
	}

} */