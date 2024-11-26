<?php 

	$now = clone $date;

	$nowMoins4 = clone $date;
	$nowMoins4->modify("-{$nb} days");

	$nowPlus4 = clone $date;
	$nowPlus4->modify("+{$nb} days");

	$nowView = $now->format('d/m/Y');
    $nowPlus4View = $nowPlus4->format('d/m/Y');

?>

<div class="calendar__date__range">
	<form action="" method="get">
		<input type="hidden" name="date" value="<?= $nowMoins4->format('Y-m-d') ?>">
		<input type="hidden" name="nb" value="<?= $nb ?>">
		<button class="btn h-100" type="submit">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 icon">
				<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
			</svg>
		</button>
	</form>

	<div class="title">
		<span class="year">Année <?= $now->format('Y') ?></span>
		<span class="range"><?= $nowView ?> - <?= $nowPlus4View ?></span>
	</div>

	<form action="" method="get">
		<input type="hidden" name="date" value="<?= $nowPlus4->format('Y-m-d') ?>">
		<input type="hidden" name="nb" value="<?= $nb ?>">
		<button class="btn h-100" type="submit">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 icon">
				<path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
			</svg>
		</button>
	</form>
</div>
