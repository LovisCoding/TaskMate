<?php
	function button(string $svgName = null, string $text, string $id , string $type= 'basique' ) : string {
		$color = 'btn-grey';
		if ($type == 'danger') $color= 'btn-danger';
		if ($type == 'marron') $color= 'btn-marron';
		
		$str = "<div class=\"button\">
		<button class=\"btn d-flex align-items-center w-100 justify-content-center {$color}\" id=\"{$id}\">";

		if ($svgName) 
			$str .= '<img class="mx-2"  src="assets/imgs/' . $svgName . '.svg" alt="' . $svgName . '" width="20px" height="20px">';
		
		$str .= $text . '</button> </div>';
		return $str;
	}
?>