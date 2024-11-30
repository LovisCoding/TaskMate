<h1>Récapitulatif des tâches</h1>

<?php

$today = new DateTime(); // Date actuelle (inclut heure et minutes)

foreach ($data as $line_date => $tasks) {
    $lineDate = new DateTime($line_date);
    // Comparer uniquement la date (sans heure)
    $todayDateOnly = $today->format('Y-m-d');
    $lineDateOnly = $lineDate->format('Y-m-d');

    if ($lineDateOnly < $todayDateOnly) {
        $dateText = $lineDate->diff($today)->format('%a') . " jours de retard"; // Retard
    } elseif ($lineDateOnly > $todayDateOnly) {
        $dateText = "Dans " . ($lineDate->diff($today)->format('%a') + 1) . " jour" . ($lineDate->diff($today)->format('%a') !== "0" ? 's' : ''); // À venir
    } else {
        $dateText = "Aujourd'hui"; // Exactement aujourd'hui
    }
?>
    <h2 style="margin: 1rem 0rem 0.75rem 0rem;"><?= $dateText ?></h2>
    <ul>
        <?php foreach ($tasks as $task) { ?>
            <li><?= $task ?></li>
        <?php } ?>
    </ul>
<?php } ?>
