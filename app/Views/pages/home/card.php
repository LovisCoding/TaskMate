<?php
	function generateCard($title, $text, $priority, $status) {
		$statusClass = '';
		$bubbleColor = '';

		if (strpos(strtolower($status), 'en retard') !== false) {
			$statusClass = 'text-black';
			$bubbleColor = 'black';
		} elseif (strpos(strtolower($status), 'en cours') !== false) {
			$statusClass = 'text-success';
			$bubbleColor = 'green';
		} elseif (strpos(strtolower($status), 'terminé') !== false) {
			$statusClass = 'text-dark';
			$bubbleColor = 'darkgreen';
		} elseif (strpos(strtolower($status), 'bloqué') !== false) {
			$statusClass = 'text-muted';
			$bubbleColor = 'gray';
		} else {
			$statusClass = 'text-muted';
			$bubbleColor = 'gray';
		}

		$priorityIndicators = '';
		for ($i = 0; $i < 4; $i++) {
			$color = $i < $priority ? 'black' : 'gray';
			$priorityIndicators .= "<span class=\"indicator $color\"></span>";
		}

		return <<<HTML
	<div class="card p-3 shadow-sm rounded-3 h-100">
		<h5 class="card-title mb-2">{$title}</h5>
		<p class="card-text text-muted overflow-hidden card-text">{$text}</p>
		<div class="d-flex align-items-center justify-content-between mt-2">
			<div class="d-flex">
				{$priorityIndicators}
			</div>
			<div class="d-flex align-items-center text-end">
				<span class="{$statusClass} small">{$status}</span>
				<span class="indicator-circle" style="background-color: {$bubbleColor};"></span>
			</div>
		</div>
	</div>
	HTML;
	}
?>