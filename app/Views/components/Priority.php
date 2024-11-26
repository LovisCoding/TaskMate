<?php 

	function Priority(int $nbActive){

		$str = '<div class="shape__list">';

		for ($i=0; $i < $nbActive; $i++) { 
			$str .= '<div class="shape shape__active"></div>';
		}

		for ($i=0; $i < 4 - $nbActive; $i++) { 
			$str .= '<div class="shape"></div>';
		}

		$str .= '</div>';

		return $str;
	}
?>