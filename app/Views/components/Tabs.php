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

		if (currentUrl === '/home/priority') {
			document.getElementById('tabPriorite').classList.add('active-tab');
		} else if (currentUrl === '/home/recap') {
			document.getElementById('tabRecap').classList.add('active-tab');
		} else if (currentUrl === '/home/state') {
			document.getElementById('tabEtat').classList.add('active-tab');
		} else if (currentUrl === '/home/deadLine') {
			document.getElementById('tabEcheance').classList.add('active-tab');
		}
	}

	window.addEventListener('load', setActiveTab);

	document.getElementById('tabPriorite').addEventListener('click', function() {
		window.location.href = '/home/priority';
	});

	document.getElementById('tabRecap').addEventListener('click', function() {
		window.location.href = '/home/recap';
	});

	document.getElementById('tabEtat').addEventListener('click', function() {
		window.location.href = '/home/state';
	});

	document.getElementById('tabEcheance').addEventListener('click', function() {
		window.location.href = '/home/deadLine';
	});
</script>