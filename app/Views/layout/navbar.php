<nav class="navbar navbar-expand-lg bg-white shadow-sm">
	<div class="d-flex" style="justify-content:space-between; width:100%">
		<a class="navbar-brand" href="<?= str_contains($_SERVER['REQUEST_URI'], '/home') ? '#' : '/home' ?>" style="margin-left: 20px;">
			<img src="/assets/imgs/logo.svg" width="150" height="80" alt="">

		</a>
		<ul class="navbar-nav gap-3 d-flex flex-row align-items-center me-4">
			<li class="nav-item">
				<a class="nav-link d-flex flex-column align-items-center <?= $_SERVER['REQUEST_URI'] == '/concentration' ? 'nav-selected' : '' ?>" href="/concentration">
					<img src="/assets/imgs/focus.svg" width="30" height="30" class="d-inline-block align-top" alt="Concentration">
					<span class="">Concentration</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link d-flex flex-column align-items-center <?= $_SERVER['REQUEST_URI'] == '/profil' ? 'nav-selected' : '' ?>" href="/profil">
					<img src="/assets/imgs/profil.svg" width="30" height="30" class="d-inline-block align-top" alt="Profil">
					<span class="">Profil</span>
				</a>
			</li>
		</ul>

</nav>
