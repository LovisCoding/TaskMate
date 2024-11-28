<?php

use App\Models\PreferencesModel;
/**
 * Ce fichier fait partie du framework CodeIgniter 4.
 *
 * (c) Fondation CodeIgniter <admin@codeigniter.com>
 *
 * Pour plus d'informations sur le copyright et les licences, consultez
 * le fichier LICENSE qui a été distribué avec cette source.
 */

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */	
$session = session();
$id_account = $session->get('id');
$preferencesModel = new PreferencesModel();
$preferences = $preferencesModel->getPreferencesByIdAccount($id_account);
// Personnalisation du rendu de la pagination
$pager->setSurroundCount($preferences['pagination_pages']); // Nombre de pages à afficher autour de la page active

if ($pager->hasPrevious()) {
	echo '<li class="page-item">
			<a class="page-link blue text-decoration-none" href="' . $pager->getFirst() . '" aria-label="First">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 icon">
					<path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
				</svg>
			</a>
		  </li>';
	echo '<li class="page-item">
			<a class="page-link blue text-decoration-none" href="' . $pager->getPrevious() . '" aria-label="Previous">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 icon">
					<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
				</svg>
			</a>
		  </li>';
}

foreach ($pager->links() as $link) {
	$activeClass = $link['active'] ? 'page-item page-active' : 'page-item';
	echo '<li class="' . $activeClass . '">
			<a class="page-link text-decoration-none" href="' . $link['uri'] . '">' . $link['title'] . '</a>
		  </li>';
}

if ($pager->hasNext()) {
	echo '<li class="page-item">
			<a class="page-link blue text-decoration-none" href="' . $pager->getNext() . '" aria-label="Next">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 icon">
					<path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
				</svg>
			</a>
		  </li>';
	echo '<li class="page-item">
			<a class="page-link blue text-decoration-none" href="' . $pager->getLast() . '" aria-label="Last">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 icon">
					<path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
				</svg>
			</a>
		  </li>';
}

echo '  </ul>
	  </nav>';
?>