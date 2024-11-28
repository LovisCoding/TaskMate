 for (let index = 0; index < 4; index++) {
	const id = 'btn-shape-' + index;

	document.getElementById('btn-shape-' + index).addEventListener('click', function (e) {
		e.preventDefault();
		const btn = document.getElementById(id);
		
		const select = document.getElementById('priority');
		const value = btn.attributes['data-id'].value;
		select.value = value
		reloadShapes(value)
		
	}, false);
	
	function reloadShapes(value) {
		const container = document.getElementById('priorityShape');
		Array.from(container.children).forEach(function (child, i) { 
			if (i < value) {
				if (!child.classList.contains('shape__active')) child.classList.add('shape__active');
				
			} else {
				if (child.classList.contains('shape__active')) child.classList.remove('shape__active')
			}
		});
	}
	
 }