<?php
function setActiveTab($url)
{
	$currentUrl = $_SERVER['REQUEST_URI'];

	if (str_contains($currentUrl, $url)) {
		return 'active-tab';
	}
	return '';
}
?>
<div class="tabs">
	<a href="/home/state" class="btn btn-link tab-link <?= setActiveTab('/home/state')?>" id="tabEtat">Vue par état</a>
	<a href="/home/priority" class="btn btn-link tab-link <?= setActiveTab('/home/priority')?>" id="tabPriorite">Vue par priorité</a>
	<a href="/home/deadLine" class="btn btn-link tab-link <?= setActiveTab('/home/deadLine')?>" id="tabEcheance">Vue par échéance</a>
	<a href="/home/recap" class="btn btn-link tab-link <?= setActiveTab('/home/recap')?>" id="tabRecap">Récapitulatif</a>
	<a href="/home/groups" class="btn btn-link tab-link <?= setActiveTab('/home/groups')?>" id="tabGroupes">Vue par groupe</a>
</div>