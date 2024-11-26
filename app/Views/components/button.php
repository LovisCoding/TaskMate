<?php
function button(string $svgName = null, string $text, string $type= 'basique') : string {
	$color = 'btn-grey';
	if ($type == 'danger') $color= 'btn-danger';
	
	$str = "<div class=\"button\">
	<button class=\"btn d-flex align-items-center {$color}\">";

	if ($svgName) 
		$str .= '<img class="mx-2"  src="assets/imgs/' . $svgName . '.svg" alt="' . $svgName . '" width="20px" height="20px">';
	
	$str .= $text . '</button>';
	return $str;
}