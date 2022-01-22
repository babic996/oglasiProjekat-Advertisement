<?php
session_start();

$dt1 = new DateTime("-1 day");
$juce = $dt1->format("Y-m-d");

$dt2 = new DateTime();
date_sub($dt2, date_interval_create_from_date_string('1 month'));
$mjesec = $dt2->format("Y-m-d");

$dt3 = new DateTime();
date_sub($dt3, date_interval_create_from_date_string('1 year'));
$godina = $dt3->format("Y-m-d");


$connection = mysqli_connect("localhost", "root", "", "oglasi");
if ($connection->connect_error) {
    die("Connection error: " . $connection->connect_error);
}

if ($_POST["exampleRadios"] == "option1") {
    $sql = "SELECT * FROM svioglasi ORDER BY datum_objavljivanja ASC";
    $result = $connection->query($sql);
} elseif ($_POST["exampleRadios"] == "option2") {
    $sql = "SELECT * FROM svioglasi
    WHERE datum_objavljivanja=DATE(NOW())";
    $result = $connection->query($sql);
} elseif ($_POST["exampleRadios"] == "option3") {
    $sql = "SELECT * FROM svioglasi
    WHERE datum_objavljivanja='$juce'";
    $result = $connection->query($sql);
} elseif ($_POST["exampleRadios"] == "option4") {
    $sql = "SELECT * FROM svioglasi
    WHERE datum_objavljivanja>='$mjesec'";
    $result = $connection->query($sql);
} elseif ($_POST["exampleRadios"] == "option5") {
    $sql = "SELECT * FROM svioglasi
    WHERE datum_objavljivanja>='$godina'";
    $result = $connection->query($sql);
}


$niz_oglasa = [];


if (!empty($result->num_rows) && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $niz_oglasa[] = $row;
    }
}

$response = "";

foreach ($niz_oglasa as $oglas) {
    $response .= '<div class="card mb-3" style="max-width: auto;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="img/' . $oglas["logo_firme"] . '" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body text-dark">
                <h5 class="card-title mb-3">' . $oglas["naziv_firme"] . ' (' . $oglas["sjediste_firme"] . ')</h5>
                <p class="card-text">' . $oglas["opis_posla"] . ' (<b>Datum isteka oglasa: ' . $oglas["datum_isteka"] . '</b>)</p>
            </div>
        </div>
    </div>
</div>';
}

echo $response;

$connection->close();
