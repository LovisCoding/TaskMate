<div class="commentaires">
	<div class="d-flex justify-content-between align-items-center">
		<h3>Commentaires</h3>
		<button type="button" id="btn-commentaire">
			<img src="/assets/imgs/plus.svg" alt="plus" width="20px" height="20px" class="">
		</button>
	</div>
<div class="">
	<div class="pt-4"></div>
</div>

<div id="commentaryList">
	<?php foreach ($commentaires as $commentaire) { ?>
		<textarea name="task_commentaries[]" onChange="onChangeTextArea(this)" class="form-control commentaire mb-3" rows="3"><?= $commentaire ?></textarea>
	<?php } ?>
</div>

</div>


