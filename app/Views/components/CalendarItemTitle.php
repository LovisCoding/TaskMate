<?php

function CalendarItemTitle($date) {

	$formatter = new IntlDateFormatter(
		'fr_FR',
		IntlDateFormatter::FULL,
		IntlDateFormatter::NONE,
		'Europe/Paris',
		IntlDateFormatter::GREGORIAN
	);

	$formattedDate = $formatter->format($date);
	$formattedDate = ucfirst($formattedDate);

	return '
		<div class="calendar_item_title">
			<span class="title">' . $formattedDate . '</span>
			<div class="line"></div>
		</div>
	';
}
?>