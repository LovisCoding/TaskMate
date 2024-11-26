<?php
include __DIR__ . '/../../components/button.php';
function Commentaires(array $commentaires): string
{
	$str = "
	<div class=\"commentaires\">
	<div class=\"d-flex justify-content-between align-items-center  \">
		<h3>Commentaires</h3>
		<button id=\"btn-commentaire\">
		<img src=\"assets/imgs/plus.svg\" alt=\"plus\" width=\"20px\" height=\"20px\" class=\"\">
	</button>
	</div>
	<div class=\" \">
	<div class=\"pt-4\"></div>
	</div>
	";
	foreach ($commentaires as $commentaire) {
		$str .= "<div class=\"commentaire\">$commentaire</div>
		<div>________</div>";
	}
	$str .= "</div>";
	return $str;
}
