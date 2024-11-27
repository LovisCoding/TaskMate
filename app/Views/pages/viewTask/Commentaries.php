
<div id="commentary" class="commentaires">

	<div class="d-flex justify-content-between align-items-center">
		<h3>Commentaires</h3>
		<button onclick="ObjCommentaries.push()" type="button" id="btn-commentaire">
			<img src="/assets/imgs/plus.svg" alt="plus" width="20px" height="20px" class="">
		</button>
	</div>

	<div class="">
		<div class="pt-4"></div>
	</div>

	<div id="commentaryList">
		<?php foreach ($commentaires['items'] as $commentaire) { ?>
			<input type="hidden" name="task_commentaries_id[]" value="<?= $commentaire['id'] ?>">
			<textarea class="form-control commentaire mb-3" rows="3" name="task_commentaries[]"><?= $commentaire['comment'] ?></textarea>
		<?php } ?>
	</div>

	<ul class="pagination" id="pagination">
		<?= $pager->links() ?>
	</ul>

</div>
  