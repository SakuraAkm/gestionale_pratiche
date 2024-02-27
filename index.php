<?php 
include_once 'inc/functions.php';
include_once 'inc/db.config.php';

$_SESSION['login'] = 0;
unset($_SESSION['error']);
unset($_SESSION['mex']);
unset($_SESSION['email_utente']);
unset($_SESSION['corso']);
get_header("Home");

crea_pratiche($conn);

?>

    <main>
        <section id="home" class="min-height d-flex align-items-center">

            <div class="row container mt-5 column-gap-5 d-flex mx-auto">

                <div class="col-lg-5 mb-5 position-relative">
                    <img src="https://img.freepik.com/premium-photo/flat-lay-home-office-desk-workspace-with-clipboard-laptop-pastel-beige-background-top-view_408798-8151.jpg" alt="" class="w-100 z-n1 d-flex position-relative">
                    <div class="z-n1 mx-auto cover position-absolute h-100 w-100 bg-dark"></div>

                    <div class="text-light cover-text position-absolute w-75 mx-auto mt-3">
                        <h1 class="display-4 fw-semibold pt-3 text-center">Visualizza</h1>
                        <p class="fs-4 pt-2 text-center">In questa sezione puoi visualizzare tutte le info riguardo le nostre pratiche:<br>Il corso in questione, il loro stato e il responsabile</p>
                    </div>

                    <button type="button" class="btn btn-info position-absolute text-light fw-semibold rounded-pill py-3 fs-5">
                        <a href="visualizza_pratiche.php">Visualizza Pratiche</a>
                    </button>
                </div>

                <div class="col-lg-5 mb-5 position-relative">
                    <img src="https://pics.craiyon.com/2023-10-03/74d58e3514074fb5baac9cfe36f9b134.webp" alt="" class="w-100 z-n1 d-flex position-relative">
                    <div class="z-n1 mx-auto cover position-absolute h-100 w-100 bg-dark"></div>

                    <div class="text-light cover-text position-absolute w-75 mx-auto mt-3">
                        <h1 class="display-4 fw-semibold pt-3 text-center">Gestisci</h1>
                        <p class="fs-4 pt-2 text-center">Da questa sezione puoi creare una tua pratica, ci serve solo la tua email, il nome del corso e il file della pratica 📑</p>
                    </div>

                    <button type="button" class="btn btn-info position-absolute text-light fw-semibold rounded-pill py-3 fs-5 ">
                        <a href="form_pratica.php">Aggiungi Pratica</a>
                    </button>
                </div>

        </section>
        
    </main>

    <?php get_footer() ?>
    
 