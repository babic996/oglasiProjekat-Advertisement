<?php
session_start();
   
$connection = mysqli_connect("localhost", "root", "", "oglasi");
if ($connection->connect_error) {
    die("Connection error: " . $connection->connect_error);
}

function make_query_pretraga($connection)
{
    $oglas = $_REQUEST["uneseni_oglas"];
    $kateg = $_REQUEST["izabrana_kategorija"];
    $lok = $_REQUEST["lokacija"];


    $sql = "SELECT * FROM svioglasi WHERE svioglasi.opis_posla LIKE '%{$oglas}%'
    OR svioglasi.kategorija_id='$kateg' OR svioglasi.sjediste_firme='$lok'";

    $result = mysqli_query($connection, $sql);
    return $result;
}
function make_oglasi_pretraga($connection)
{
    $output = '';
    $result = make_query_pretraga($connection);
    while ($row = mysqli_fetch_array($result)) {
        $output .= '<div class="card mb-3" style="max-width: auto;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="img/' . $row["logo_firme"] . '" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body text-dark">
                    <h5 class="card-title mb-3">' . $row["naziv_firme"] . ' (' . $row["sjediste_firme"] . ')</h5>
                    <p class="card-text">' . $row["opis_posla"] . ' (<b>Datum isteka oglasa: ' . $row["datum_isteka"] . '</b>)</p>
                </div>
            </div>
        </div>
    </div>';
    }
    return $output;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index-style.css">
    <title>Pregled oglasa</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark" id="main-nav" style="background-color: #bc4b51;">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/social-ad-reach.png" alt="" width="40" height="40" class="d-inline-block align-text-center">
                OnlineOglasi
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item active">
                        <a href="index.php" class="nav-link">Pocetna stranica</a>
                    </li>
                    <li class="nav-item">
                        <a href="oglasi.php" class="nav-link">Svi oglasi</a>
                    </li>
                    <?php
                    if (empty($_SESSION["loggedInUser"])) {
                        echo '<li class="nav-item">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="registration.php" class="nav-link">Registruj se</a>
                    </li>';
                    }
                    ?>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">Kontakti</a>
                    </li>
                    <?php
                    if (!empty($_SESSION["loggedInUser"])) {
                        echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nalog
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="mojioglasi.php">Moji oglasi</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addPost">Dodaj oglas</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Odjavi se</a></li>
                        </ul>
                    </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Searching -->
    <section id="newsletter" class="text-white py-5" style="background-color: #f4b266;">
        <div class="container">
            <div class="row">
                <form method="GET" action="oglasi.php">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="uneseni_oglas" id="uneseni_oglas" class="form-control form-control-lg mb-resp mb-2 mt-2" placeholder="Pretrazi oglase">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="izabrana_kategorija" id="izabrana_kategorija" class="form-select form-select-lg mb-2 mt-2">
                                    <option selected>Izaberite kategoriju</option>
                                    <option value="1">Administrativne i slične usluge</option>
                                    <option value="2">Arhitektonske usluge</option>
                                    <option value="3">Bankarstvo</option>
                                    <option value="4">Ekologija</option>
                                    <option value="5">Ekonomija i finansije</option>
                                    <option value="6">Elektrotehnika - Mašinstvo</option>
                                    <option value="7">Energetika</option>
                                    <option value="8">IT</option>
                                    <option value="9">Ljepota i zdravlje</option>
                                    <option value="10">Nekretnine</option>
                                    <option value="11">Turizam</option>
                                    <option value="12">Zdravstvo</option>
                                    <option value="13">Zanatske usluge</option>
                                    <option value="14">Pravo</option>
                                    <option value="15">Prehrambena industrija</option>
                                    <option value="16">Ostalo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" name="lokacija" id="lokacija" class="form-control form-control-lg mb-resp mb-2 mt-2" placeholder="Grad, lokacija">
                            </div>
                        </div>
                        <div class="col-md-3 d-grid gap-2">
                            <button type="submit" class="btn mb-2 mt-2 text-white" style="background-color: #bc4b51;">
                                <i class="fas fa-envelope-open-o"></i> Trazi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="svi_oglasi" class="text-white py-3" style="background-color: #6b9080;">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 style="text-align: left" class="mb-5" ;>Vrijeme objave</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="bilokada" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Bilo kada
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="danas" value="option2">
                        <label class="form-check-label" for="exampleRadios2">
                            Danas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="juce" value="option3">
                        <label class="form-check-label" for="exampleRadios3">
                            Juce
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="mjesecranije" value="option4">
                        <label class="form-check-label" for="exampleRadios5">
                            Mjesec ranije
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="godinuranije" value="option5">
                        <label class="form-check-label" for="exampleRadios6">
                            Godinu ranije
                        </label>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 style="text-align: center" class="mb-5" ;>Oglasi</h3>
                    <div class="container">
                        <div class="col" id="result">
                            <?php if (isset($_REQUEST["uneseni_oglas"]) || isset($_REQUEST["izabrana_kategorija"]) || isset($_REQUEST["lokacija"])) {
                                echo make_oglasi_pretraga($connection);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!--MODAL-->
    <div class="modal fade" tabindex="-1" id="loginModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #bc4b51;">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="validateLogin.php" id="form">
                        <div class="form-group mb-3">
                            <label for="E-mail">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn text-white" style="background-color: #6b9080;">Potvrdi</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Izadji</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD POST MODAL -->
    <div class="modal fade" tabindex="-1" id="addPost">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Dodaj oglas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="validateOglas.php" id="form">
                        <div class="form-group mb-3">
                            <label for="Naziv firme">Naziv firme</label>
                            <input type="text" class="form-control" name="naziv_firme" id="naziv_firme" require>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Sjediste firme">Sjediste firme</label>
                            <input type="text" class="form-control" name="sjediste_firme" id="sjediste_firme" require>
                        </div>
                        <div class="form-group mb-3">
                            <select name="listaKategorija" class="form-select" aria-label="Default select example">
                                <option selected>Izaberite kategoriju oglasa</option>
                                <option value="1">Administrativne i slične usluge</option>
                                <option value="2">Arhitektonske usluge</option>
                                <option value="3">Bankarstvo</option>
                                <option value="4">Ekologija</option>
                                <option value="5">Ekonomija i finansije</option>
                                <option value="6">Elektrotehnika - Mašinstvo</option>
                                <option value="7">Energetika</option>
                                <option value="8">IT</option>
                                <option value="9">Ljepota i zdravlje</option>
                                <option value="10">Nekretnine</option>
                                <option value="11">Turizam</option>
                                <option value="12">Zdravstvo</option>
                                <option value="13">Zanatske usluge</option>
                                <option value="14">Pravo</option>
                                <option value="15">Prehrambena industrija</option>
                                <option value="16">Ostalo</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <div>
                                <label for="formFile" class="form-label">Logo firme</label>
                                <input class="form-control" type="file" id="logo_firme" name="logo_firme">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Opis posla">Opis posla</label>
                            <textarea name="opis_posla" id="opis_posla" class="form-control" require></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Potvrdi</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Izadji</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->

    <footer class="text-center text-lg-start" style="background-color: #bc4b51;">
        <div class="container d-flex justify-content-center py-5">
            <button type="button" class="btn btn-primary btn-lg btn-floating mx-2" style="background-color: #54456b;">
                <i class="fab fa-facebook-f"></i>
            </button>
            <button type="button" class="btn btn-primary btn-lg btn-floating mx-2" style="background-color: #54456b;">
                <i class="fab fa-youtube"></i>
            </button>
            <button type="button" class="btn btn-primary btn-lg btn-floating mx-2" style="background-color: #54456b;">
                <i class="fab fa-instagram"></i>
            </button>
            <button type="button" class="btn btn-primary btn-lg btn-floating mx-2" style="background-color: #54456b;">
                <i class="fab fa-twitter"></i>
            </button>
        </div>

        <!-- Copyright -->
        <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            <p class="lead">
                Copyright &copy;
                <span id="year"></span>
            </p>
        </div>
        <!-- Copyright -->
    </footer>





    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                var exampleRadios = $(this).val();
                $.ajax({
                    url: "getData.php",
                    method: "POST",
                    data: {
                        exampleRadios: exampleRadios
                    },
                    success: function(data) {
                        $('#result').html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>