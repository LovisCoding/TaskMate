<div class="tabs">
	<button class="btn btn-link tab-link" id="tabEtat">Vue par état</button>
	<button class="btn btn-link tab-link" id="tabPriorite">Vue par priorité</button>
	<button class="btn btn-link tab-link" id="tabEcheance">Vue par échéance</button>
	<button class="btn btn-link tab-link" id="tabRecap">Récapitulatif</button>
</div>

<script>
	function setActiveTab() {

		const currentUrl = window.location.pathname;

		const tabs = document.querySelectorAll('.tab-link');
		tabs.forEach(tab => {
			tab.classList.remove('active-tab');
		});

		if (currentUrl === '/priority') {
			document.getElementById('tabPriorite').classList.add('active-tab');
		} else if (currentUrl === '/home') {
			document.getElementById('tabRecap').classList.add('active-tab');
		} else if (currentUrl === '/state') {
			document.getElementById('tabEtat').classList.add('active-tab');
		} else if (currentUrl === '/deadLine') {
			document.getElementById('tabEcheance').classList.add('active-tab');
		}
	}

	window.addEventListener('load', setActiveTab);

	document.getElementById('tabPriorite').addEventListener('click', function() {
		window.location.href = '/priority';
	});

	document.getElementById('tabRecap').addEventListener('click', function() {
		window.location.href = '/home';
	});

	document.getElementById('tabEtat').addEventListener('click', function() {
		window.location.href = '/state';
	});

	document.getElementById('tabEcheance').addEventListener('click', function() {
		window.location.href = '/deadLine';
	});
</script>