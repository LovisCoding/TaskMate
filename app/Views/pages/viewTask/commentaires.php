<div class="commentaires">
	<div class="d-flex justify-content-between align-items-center">
		<h3>Commentaires</h3>
		<button id="btn-commentaire">
			<img src="/assets/imgs/plus.svg" alt="plus" width="20px" height="20px" class="">
		</button>
	</div>
<div class="">
	<div class="pt-4"></div>
</div>

<?php foreach ($commentaires as $commentaire) { ?>
	<div class="commentaire"><?= $commentaire ?></div>
	<div>________</div>
<?php } ?>
</div>