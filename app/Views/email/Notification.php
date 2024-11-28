<h1>Récapitulatif des deadlines des tâches</h1>

<?php
$today = new DateTime(); // Date actuelle

foreach ($data as $line_date => $tasks) {
    $lineDate = new DateTime($line_date);
    $interval = $today->diff($lineDate);
    $days = (int)$interval->format('%r%a'); // Nombre de jours avec le signe positif/négatif

    // Déterminer le texte à afficher
    if ($days < 0) {
        $dateText = abs($days) . " jours de retard"; // Retard
    } elseif ($days > 0) {
        $dateText = "dans $days jours"; // À venir
    } else {
        $dateText = "aujourd'hui"; // Aujourd'hui
    }
?>
    <h2 style="margin: 1rem 0rem 0.75rem 0rem;"><?= $dateText ?></h2>
    <ul>
        <?php foreach ($tasks as $task) { ?>
            <li><?= $task ?></li>
        <?php } ?>
    </ul>
<?php } ?>
