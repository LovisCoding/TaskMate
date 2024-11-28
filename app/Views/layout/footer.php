<?=str_contains($_SERVER['REQUEST_URI'], '/home') ? view('pages/home/filterPanel') : ''?>
</body>

<script>

/* 	let commentaryTemplate = `<textarea name="task_commentaries[]" onChange="onChangeTextArea(this)" class="form-control commentaire mb-3" rows="3"></textarea>`;
	let btnAddCommentary = document.getElementById('btn-commentaire');
	commentaryList = document.getElementById('commentaryList'); */
	let selectPriority = document.getElementById('priority');
	let prioritiesShapes = document.getElementById('priorityShape');




/* 	btnAddCommentary.addEventListener('click', () => {
		let c = document.createElement('textarea');
		c.name = "task_commentaries[]";
		c.className = "form-control commentaire mb-3";
		c.rows = 3;
		c.textContent = "";
		pushCommentary(c);
		nbPage = 0;
		fetchCommentaryPage(nbPage,nbElement);
	}) */

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

/* 	function onChangeTextArea(elem){
		if (elem.value == '') commentariesNodes.delete(elem);
		else elem.textContent = elem.value
	} */


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/scripts/concentration.js"></script>
<script>
	const base_url_img = '<?=base_url('assets/imgs/')?>';
</script>
<?=str_contains($_SERVER['REQUEST_URI'], '/home') ? '<script type="module" src="/assets/scripts/home/home.js"></script>': '' ?>
<?=str_contains($_SERVER['REQUEST_URI'], '/task') ? '<script type="module" src="/assets/scripts/home/PriorityBtn.js"></script>': '' ?>
</html>