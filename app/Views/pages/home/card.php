<?php
	function generateCard($title, $text, $priority, $status) {
		$statusClass = '';
		$bubbleColor = '';

		switch (strtolower($status)) {
			case 'en retard':
				$statusClass = 'text-black';
				$bubbleColor = 'black';
				break;
			case 'en cours':
				$statusClass = 'text-success';
				$bubbleColor = 'green';
				break;
			case 'terminé':
				$statusClass = 'text-dark';
				$bubbleColor = 'darkgreen';
				break;
			case 'bloqué':
				$statusClass = 'text-muted';
				$bubbleColor = 'gray';
				break;
			default:
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