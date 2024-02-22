<?php
include_once 'inc/functions.php';
get_header("Aggiungi Pratica");
?>

<body>
    <main>
    <section id="form" class="min-height">
        <form action="aggiungi_pratica.php" method="post">
            <div class="container position-relative py-5 d-flex justify-content-center align-items-center">
                <div>
                    <div class="mb-3">
                        <label for="emailUtente" class="form-label">Email Utente</label>
                        <input type="email" class="form-control" id="emailUtente" name="emailUtente">
                    </div>
                    <div class="mb-3">
                        <label for="corso" class="form-label">Corso</label>
                        <input type="text" class="form-control" id="corso" name="corso">
                    </div>
                    <div class="mb-3">
                        <label for="documenti" class="form-label">Documenti</label>
                        <input class="form-control" type="file" id="documenti"  name="documenti" multiple>
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
    