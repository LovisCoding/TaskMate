

<div id="commentary" class="concentration-commentaries shadow me-2">

	<div class="d-flex justify-content-center mb-3">
		<h4>Commentaires</h4>
	</div>

	<div id="commentaryList">
		<?php foreach ($commentaries['items'] as $commentary) { ?>
			<p class="form-control commentaire mb-3" rows="3" name="task_commentaries[]">
				<?= $commentary['comment'] ?>
			</p>
		<?php } ?>
	</div>

	<ul class="pagination" id="pagination">
		<?= $pager->links('default', 'default_paginate') ?>
	</ul>

</div>

