<?php
include 'tabs.php';
include 'filter.php';
include 'export.php';
include 'card.php';
?>
<div class="d-flex" id="vues">
	<?=tabs()?>
	<?=export()?>
	<?=filter()?>
	<?=generateCard("Tâche 1", "Texte descriptif ici.", 3, "en retard");?>
	<?=generateCard("Tâche 1", "Texte descriptif ici.", 4, "en cours");?>
	<?=generateCard("Tâche 1", "Texte descriptif ici.", 4, "terminé");?>
	<?=generateCard("Tâche 1", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis dapibus luctus orci a feugiat. Ut condimentum feugiat vehicula. Donec eget ipsum tempor, tincidunt enim eget, aliquet massa. Mauris eget euismod justo. Curabitur mattis urna sit amet dui finibus aliquam. Pellentesque mauris justo, dignissim ac sodales vitae, pulvinar vitae libero. Vivamus dapibus efficitur enim et faucibus. Nullam dictum eros eu tempor sodales. Donec ante velit, rutrum eget vehicula eu, feugiat vel ipsum. Morbi viverra iaculis ex sit amet sodales.

Proin posuere id mauris vel efficitur. Integer vitae suscipit nulla. Pellentesque sed pretium enim. Morbi ac vulputate libero. Aliquam erat volutpat. Mauris lobortis mauris nec cursus lobortis. Maecenas nec magna justo. Integer consectetur odio eget lectus pharetra dapibus. Donec nec odio eget sapien imperdiet posuere. Quisque lobortis, urna sit amet pharetra laoreet, risus risus pellentesque est, ut condimentum odio neque non dui. Sed a quam massa. Donec ipsum arcu, faucibus eu purus eu, posuere finibus diam.

Aliquam erat volutpat. Maecenas ut bibendum diam. Cras eget semper lorem. Maecenas pellentesque justo eget varius commodo. Phasellus eu purus sed arcu vulputate tempor et ut dui. Sed at rhoncus lacus. Morbi purus ante, malesuada ac tortor quis, congue sagittis massa. Vivamus vel euismod est, in cursus velit. Ut tincidunt eu erat ac convallis. Fusce vitae magna in turpis accumsan tempor vel sit amet mi. Morbi a justo justo. Vestibulum tempor ultricies orci ut ornare.

Nam fringilla at elit rutrum tristique. Aliquam condimentum, ante quis euismod interdum, metus arcu placerat turpis, et sodales leo elit vitae eros. In interdum semper nulla at efficitur. Donec pretium orci ipsum, vitae pellentesque metus feugiat ut. Suspendisse semper dui id elit bibendum vehicula. Nam orci tellus, imperdiet eget tellus tincidunt, vulputate iaculis dolor. Proin lacus ligula, egestas id felis eu, auctor elementum metus. Ut euismod turpis ut fermentum congue. Mauris.", 4, "bloqué");?>
</div>