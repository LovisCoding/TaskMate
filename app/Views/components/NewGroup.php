

<?php
	$color = 'btn-grey';
	if ( !isset($value) ) $value = "";
	if( !isset($disabled)) $disabled = "";
    $svgName = "u-group";
    $textContent = "Nouvelle Tâche";
?>

<a class="btn" href="/newGroup" style="padding: 0;margin: 0;" >
    <button type="submit" name="<?= isset($name) ? $name : 'action' ?>" value="<?= isset($value) ? $value : '' ?>" class="btn d-flex align-items-center w-100 justify-content-center <?= $color ?>" id="btn-new-task" <?=$disabled ? 'disabled' : ''?>>
	<?php if (isset($svgName)) { ?>
            <img class="mx-2" src="/assets/imgs/<?= $svgName ?>.svg" alt="<?= $svgName ?>" width="20px" height="20px">
        <?php } ?>
	<span><?= $textContent ?></span>

    </button>
</a>

