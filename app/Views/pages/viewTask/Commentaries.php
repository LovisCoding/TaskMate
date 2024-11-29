<div id="commentary" class="commentaires">

	<div class="d-flex justify-content-between align-items-center">
		<h3>Commentaires</h3>
		<button name="addCommentary" value="true" id="btn-commentaire">
			<img src="/assets/imgs/plus.svg" alt="plus" width="20px" height="20px" class="">
		</button>
	</div>

	<div class="">
		<div class="pt-4"></div>
	</div>

	<div id="commentaryList">
		<?php foreach ($commentaires['items'] as $commentaire) { ?>
			<div class="d-flex align-items-center">
				
				<input type="hidden" name="task_commentaries_id[]" value="<?= $commentaire['id'] ?>">
				<textarea class="form-control commentaire mb-3" rows="3" name="task_commentaries[]"><?= $commentaire['comment'] ?></textarea>
				<button name="DeleteCommentary" value="<?= $commentaire['id'] ?>" style="height: fit-content" class="btn mb-3" type="submit">
					<img src="/assets/imgs/trash.svg" alt="trash" width="20px" height="20px"  >
				</button>
			</div>
		<?php } ?>
	</div>

	<ul class="pagination" id="pagination">
		<?= $pager->links('default', 'default_paginate') ?>
	</ul>

</div>