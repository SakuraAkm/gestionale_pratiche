<?php
include_once("inc/functions.php");
get_header("Aggiungi Pratica");
?>

<body>
    <main>
    <section id="form">
        <form action="upload.php" method="post">
            <div class="container position-relative py-5 d-flex justify-content-center align-items-center">
                <div>
                    <div class="mb-3">
                        <label for="emailUtente" class="form-label">Email Utente</label>
                        <input type="email" class="form-control" id="emailUtente">
                    </div>
                    <div class="mb-3">
                        <label for="corso" class="form-label">Corso</label>
                        <input type="text" class="form-control" id="corso">
                    </div>
                    <div class="mb-3">
                        <label for="documenti" class="form-label">Documenti</label>
                        <input class="form-control" type="file" id="documenti" multiple>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Invia</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>

    <?php get_footer() ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/assets/js/script.js"></script>
</body>
</html>