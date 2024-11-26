export default function () {
	const filterPanel = document.getElementById('filterPanel');

    // Initialise le composant Offcanvas avec l'API Bootstrap
    const bootstrapOffcanvas = new bootstrap.Offcanvas(filterPanel);

    // Fonction pour ouvrir le panneau
    function openFilterPanel() {
        bootstrapOffcanvas.show();
    }
	openFilterPanel();
}