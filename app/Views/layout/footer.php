</body>

<script>

	let commentaryTemplate = `<textarea name="task_commentaries[]" class="form-control commentaire mb-3" rows="3"></textarea>`;
	let btnAddCommentary = document.getElementById('btn-commentaire');
	let commentaryList = document.getElementById('commentaryList');
	let selectPriority = document.getElementById('priority');
	let prioritiesShapes = document.getElementById('priorityShape');

	btnAddCommentary.addEventListener('click', () => {
		commentaryList.innerHTML += commentaryTemplate;
	})

	selectPriority.addEventListener('change', (event) => {
		let a = `<div class="shape shape__active"></div>`;
		let b = `<div class="shape"></div>`;
		prioritiesShapes.innerHTML = "";
		for (let i = 0; i < parseInt(event.target.value); i++) {
			prioritiesShapes.innerHTML += a;
		}
		for (let i = 0; i < 4 - parseInt(event.target.value); i++) {
			prioritiesShapes.innerHTML += b;
		}
	})

	function onChangeTextArea(elem){
		elem.textContent = elem.value
	}


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?=str_contains($_SERVER['REQUEST_URI'], '/home') ? '<script type="module" src="/assets/scripts/home/home.js"></script>': '' ?>
</html>