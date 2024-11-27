export default function () {
	const button = document.getElementById('toggleSortOrder')
	const img = button.querySelector('img');
	const currentOrder = img.alt; // "asc" ou "desc"

	// Basculer l'image et le paramètre 'sort_order' dans l'URL
	const newOrder = currentOrder === 'asc' ? 'desc' : 'asc';
	const newImageSrc = newOrder === 'asc' ? 'asc.svg' : 'desc.svg';
	const form = document.getElementById('filterForm');

	// Modifier l'image du bouton
	img.src = base_url_img + newImageSrc;
	img.alt = newOrder;

	// Récupérer le champ caché pour 'sort_order' et modifier sa valeur
	const sortOrderField = form.querySelector('input[name="sort_order"]');
	sortOrderField.value = newOrder; // Mise à jour de la valeur du champ caché
}