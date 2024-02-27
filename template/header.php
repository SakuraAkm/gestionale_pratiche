<?php   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 
        <?php echo $title ?> 
    </title>
    <link rel="shortcut icon" href="http://<?php echo APP_URI ?>/assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href= "http://<?php echo APP_URI ?>/assets/css/style.css">
</head>

<body class="text-dark">
    <header>
        <nav class="navbar bg-primary py-3">
            <div class="container-fluid container">

                <a id="logo" class="navbar-brand text-light fs-3 fw-semibold" href="http://<?php echo APP_URI ?>/index.php">Gestionale Pratiche</a>

                <div class="ms-auto d-flex align-items-center">
                    <button type="button" class="btn btn-info text-light fw-semibold rounded-pill px-2 fs-5">
                        <?php if($_SESSION['login'] == false){ ?>
                            <a href="http://<?php echo APP_URI ?>/login_admin.php">Login</a>
                        <?php } else { ?>
                            <a href="http://<?php echo APP_URI ?>/visualizza_admin.php">Gestisci Pratiche</a>
                        <?php } ?>
                    </button>

                    <?php if($_SESSION['login']){ ?>
                        <div class="ms-3" id="profilo">
                            <img src="http://<?php echo APP_URI ?>/assets/profilo.png" alt="Profilo" class="rounded-pill">
                        </div>
                    <?php } ?>
                </div>

            </div>
            
          </nav>

          <div id="profilo-form" class="visually-hidden opacity-0 rounded position-fixed z-1 mx-auto" enctype="multipart/form-data">

            <form action="http://<?php echo APP_URI ?>/admin/aggiorna_profilo.php" method="POST" class="w-75 mx-auto">
                <h1 class="fs-2 fw-semibold text-center pb-1">Profilo</h1>
                <p class="text-center pb-4">Da qui puoi modificare i tuoi dati</p>

                <div class="mb-3">
                    <label for="email-profilo" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email-profilo" id="email-profilo" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="password-profilo" class="form-label">Password</label>
                    <input type="password" name="password-profilo" class="form-control" id="password-profilo" required>
                </div>
                <div class="d-flex justify-content-center mb-4">
                    <button type="submit" class="btn btn-warning fs-5 mt-3">Aggiorna</button>
                </div>

            </form>
          </div>
    </header> 