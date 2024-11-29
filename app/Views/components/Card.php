<?php
$title = $title ?? '';
$date = $date ?? '';
$text = $text ?? '';
$priority = $priority ?? 0;
$status = $status ?? '';
$color = $color ?? false;
$statusClass = '';
$bubbleClass = '';
$borderClass = '';
$id = $id ?? '';

setlocale(LC_TIME, 'fr_FR.UTF-8');

$date = new DateTime($date);
$formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
$dateFormatted = $formatter->format($date);

if (strpos(strtolower($status), 'en retard') !== false) {
	$statusClass = 'text-danger';
	$bubbleClass = 'bg-danger';
} elseif (strpos(strtolower($status), 'en cours') !== false) {
	$statusClass = 'text-warning';
	$bubbleClass = 'bg-warning';
} elseif (strpos(strtolower($status), 'terminée') !== false) {
	$statusClass = 'text-success';
	$bubbleClass = 'bg-success';
} elseif (strpos(strtolower($status), 'bloquée') !== false) {
	$statusClass = 'text-primary';
	$bubbleClass = 'bg-primary';
} elseif (strpos(strtolower($status), 'pas commencée') !== false) {
	$statusClass = 'text-dark';
	$bubbleClass = 'bg-secondary';
}

if ($color) {
	$borderClass = 'border-' . $statusClass;
}

$priorityIndicators = '';
for ($i = 0; $i < 4; $i++) {
	$color = $i < $priority ? 'black' : 'lightgray';
	$priorityIndicators .= "<span class=\"indicator $color\"></span>";
}
?>

<a href="/task/<?= htmlspecialchars($id) ?>" class="card p-3 shadow-sm rounded-3 text-decoration-none <?= $borderClass ?>">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<div class="d-flex">
			<?= $priorityIndicators ?>
		</div>
		<div class="d-flex gap-2">
			<span class="small"><?= $dateFormatted ?></span>
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" style="width:1rem">
				<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
			</svg>
		</div>
	</div>
	<h5 class="card-title mb-2"><?= htmlspecialchars($title) ?></h5>
	<p class="card-text text-muted overflow-hidden"><?= htmlspecialchars($text) ?></p>
	<div class="d-flex align-items-center justify-content-between mt-3">
		<div class="d-flex align-items-center gap-2">
			<span class="indicator-circle <?= $bubbleClass ?>"></span>
			<span class="<?= $statusClass ?> small"><?= htmlspecialchars($status) ?></span>
		</div>
		<span class="text-danger small"><?= htmlspecialchars($retard) ?></span>
	</div>
</a>