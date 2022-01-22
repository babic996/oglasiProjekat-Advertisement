<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "oglasi");
if ($connection->connect_error) {
    die("Connection error: " . $connection->connect_error);
}


function make_moji_oglasi($connection)
{
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }
    $num_per_page = 02;
    $start_from = ($page-1)*02;
    $id = $_SESSION["loggedInUser"]["ID"];
    $sql = "SELECT * FROM svioglasi WHERE svioglasi.id_poslodavca='$id' ORDER BY datum_objavljivanja ASC
    LIMIT $start_from,$num_per_page";
    $result = mysqli_query($connection, $sql);
    $output = '';
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
    $pr_query = "SELECT * FROM svioglasi WHERE svioglasi.id_poslodavca='$id' ORDER BY datum_objavljivanja ASC";
    $pr_result = mysqli_query($connection,$pr_query);
    $total_record = mysqli_num_rows($pr_result );
    $total_page = ceil($total_record/$num_per_page);
    $output.='<nav aria-label="Page navigation example">
<ul class="pagination">';
if($page>1)
{
    $output.='<li class="page-item"><a class="page-link" href="mojioglasi.php?page='.($page-1).'">Previous</a></li>';
}
for($i=1;$i<$total_page;$i++)
{
    $output.='<li class="page-item"><a class="page-link" href="mojioglasi.php?page='.$i.'">'.$i.'</a></li>';
}
if($i>$page)
{
    $output.='<li class="page-item"><a class="page-link" href="mojioglasi.php?page='.($page+1).'">Next</a></li>';
}
$output.='</ul>
</nav>';
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
    <title>Moji oglasi</title>
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

    <section id="moji_oglasi" class="text-white py-3" style="background-color: #f4b266;">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <h3 style="text-align: center"; class="mb-5">Moji oglasi</h3>
                    <div class="container">
                        <div class="col">
                            <?php echo make_moji_oglasi($connection); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



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
</body>

</html>