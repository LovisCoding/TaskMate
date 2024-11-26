<?php
	function export() {
		$imgSrc = base_url("assets/imgs/export.svg");
		return '
		<div class="export" id="btn-export">
			<button class="btn btn-link export d-flex align-items-center" >
				Exporter
				<img src="' . $imgSrc . '" alt="filter" width="20px" height="20px" />
			</button>
		</div>
		';
	}
?>