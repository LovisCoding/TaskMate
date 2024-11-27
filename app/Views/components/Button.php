<?php
	$color = 'btn-grey';
	if ( isset($type) ){
		if ($type == 'danger') $color= 'btn-danger';
		if ($type == 'marron') $color= 'btn-marron';
	}
	if ( !isset($id) ) $id = "";
	if ( !isset($value) ) $value = "";
?>

<div class="button">
    <button type="submit" name="<?= isset($name) ? $name : 'action' ?>" value="<?= isset($value) ? $value : '' ?>" class="btn d-flex align-items-center w-100 justify-content-center <?= $color ?>" id="<?= $id ?>">
        <span> <?= $text ?> </span>
        <?php if (isset($svgName)) { ?>
            <img class="mx-2" src="/assets/imgs/<?= $svgName ?>.svg" alt="<?= $svgName ?>" width="20px" height="20px">
        <?php } ?>
    </button>
</div>
