<?php
	$title = $title ?? '';
	$text = $text ?? '';
	$priority = $priority ?? 0;
	$status = $status ?? '';
	$color = $color ?? false;
	$statusClass = '';
	$bubbleClass = '';
	$borderClass = '';
	$id = $id ?? '';

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
		$color = $i < $priority ? 'black' : 'gray';
		$priorityIndicators .= "<span class=\"indicator $color\"></span>";
	}
?>

<a href="/task/<?= htmlspecialchars($id) ?>" class="card p-3 shadow-sm rounded-3 text-decoration-none <?= $borderClass ?>" >
	<h5 class="card-title mb-2"><?= htmlspecialchars($title) ?></h5>
	<p class="card-text text-muted overflow-hidden"><?= htmlspecialchars($text) ?></p>
	<div class="d-flex align-items-center justify-content-between mt-2">
		<div class="d-flex">
			<?= $priorityIndicators ?>
		</div>
		<div class="d-flex align-items-center text-end">
			<span class="<?= $statusClass ?> small"><?= htmlspecialchars($status) ?></span>
			<span class="indicator-circle <?= $bubbleClass ?>"></span>
		</div>
	</div>
</a>