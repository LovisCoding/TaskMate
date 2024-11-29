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
	<a href="/home/state" class="btn btn-link tab-link <?= setActiveTab('/home/state')?>" id="tabEtat">Etat</a>
	<a href="/home/priority" class="btn btn-link tab-link <?= setActiveTab('/home/priority')?>" id="tabPriorite">Priorité</a>
	<a href="/home/deadLine" class="btn btn-link tab-link <?= setActiveTab('/home/deadLine')?>" id="tabEcheance">Echéance</a>
	<a href="/home/groups" class="btn btn-link tab-link <?= setActiveTab('/home/groups')?>" id="tabGroupes">Groupe</a>
	<a href="/home/recap" class="btn btn-link tab-link <?= setActiveTab('/home/recap')?>" id="tabRecap">Récapitulatif</a>
</div>