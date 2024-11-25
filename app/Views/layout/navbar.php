<nav class="navbar navbar-expand-lg bg-white">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= $_SERVER['REQUEST_URI'] == '/home' ? '#' : '/home'?>" style="margin-left: 20px;">
			<img src="assets/imgs/logo.svg" width="150" height="80" alt="">
		</a>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link d-flex flex-column align-items-center <?= $_SERVER['REQUEST_URI'] == '/profil' ? 'nav-selected' : ''?>" href="/profil">
					<img src="/assets/imgs/profil.svg" width="30" height="30" class="d-inline-block align-top" alt="Profil">
					<span class="">Profil</span>
				</a>
			</li>
		</ul>
</nav>