<?php
session_start();
if (isset($_COOKIE["wrongPassword"])) {
    setcookie("wrongPassword", false);
    include_once "obavjestenje.php";
}
if (isset($_COOKIE["sameEmail"])) {
    setcookie("sameEmail", false);
    include_once "sameEmail.php";
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
    <title>Registracija</title>
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
                            <li><a class="dropdown-item" href="#">Moji oglasi</a></li>
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
    <!-- PAGE HEADER -->
    <header id="registration-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto text-center">
                    <h1>Registruj se</h1>
                    <p>Postanio dio nase velike zajednice</p>
                </div>
            </div>
        </div>
    </header>

    <!-- REGISTER SECTION -->
    <section id="contact" class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="card p-4" style="background-color: #6b9080;">
                        <div class="card-header text-light text-center" style="background-color: #f4b266;">
                            Molimo Vas da popunite formu
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <form method="POST" action="validateRegistration.php" id="form">
                                    <div class="col-md">
                                        <div class="form-group">
                                            <input type="text" name="ime" id="ime" class="form-control mb-3" placeholder="Ime" required>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <input type="text" name="prezime" id="prezime" class="form-control mb-3" placeholder="Prezime" required>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control mb-3" placeholder="E-mail" required>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <input type="text" name="telefon" id="telefon" class="form-control mb-3" placeholder="Broj telefona" required>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <input pattern=".{8,}" title="8 znamenki minimalno" type="password" name="password" id="password" class="form-control mb-3" placeholder="Lozinka" required>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <input pattern=".{8,}" title="8 znamenki minimalno" type="password" name="pon_password" id="pon_password" class="form-control mb-3" placeholder="Ponovi lozinku" required>
                                        </div>
                                    </div>
                                    <div class="col-md d-grid gap-2">
                                        <button type="submit" class="btn btn-outline-light mb-2 mt-2">
                                            <i class="fas fa-envelope-open-o"></i> Potvrdi registraciju
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
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

    <!-- CONTACT -->
    <section id="contact" class="py-5" style="background-color: #f4b266;">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h3 class="text-white">Kontaktirajte nas</h3>
                    <form method="GET" action="validateKontakt.php">
                        <div class="form-group mb-3">
                            <div class="input-group input-group-lg mb-3">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input type="text" name="ime_kontakta" id="ime_kontakta" class="form-control" placeholder="Ime" aria-label="ime" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-lg mb-3">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" name="email_kontakta" id="email_kontakta" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="input-group input-group-lg mb-3">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <textarea class="form-control" placeholder="Poruka" name="poruka_kontakta" id="poruka_kontakta" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="col-md d-grid gap-2">
                            <button type="submit" class="btn btn-outline-light mb-2 mt-2">
                                <i class="fas fa-envelope-open-o"></i> Posalji poruku
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-3 align-self-center">
                    <img src="img/social-ad-reach.png" alt="" class="img-fluid">
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


    <script>
        // Get the current year for the copyright
        $('#year').text(new Date().getFullYear());

        // Init Scrollspy
        $('body').scrollspy({
            target: '#main-nav'
        });

        // Smooth Scrolling
        $("#main-nav a").on('click', function(event) {
            if (this.hash !== "") {
                event.preventDefault();

                const hash = this.hash;

                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function() {

                    window.location.hash = hash;
                });
            }
        });
    </script>
</body>

</html>