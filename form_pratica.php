<?php
include_once 'inc/functions.php';
get_header("Aggiungi Pratica");
?>

<main>
    <?php if(isset($_SESSION['error']) ) :?>
        <div class="my-alert text-center opacity alert alert-danger mx-auto viewport-20 position-fixed" role="alert"><?php echo $_SESSION['error']; ?></div>
    <?php unset($_SESSION['error']); endif; ?>
    <section class="min-height d-flex justify-content-center align-items-center w-25 mx-auto">
        <form action="aggiungi_pratica.php" method="POST" enctype="multipart/form-data">
            <h1 class="display-5 text-uppercase fw-semibold text-center">Inserisci Pratica</h1>
            <div class="container position-relative py-5 d-flex justify-content-center align-items-center">
                <div>
                    <div class="mb-3">
                        <label for="emailUtente" class="form-label">Email Utente</label>
                        <input type="email" class="form-control" id="emailUtente" name="emailUtente" 
                        <?php if(isset($_SESSION['email_utente'])) : ?> value ="<?php echo $_SESSION['email_utente']; ?>" <?php unset($_SESSION['email_utente']); endif ?> required>
                    </div>
                    <div class="mb-3">
                        <label for="corso" class="form-label">Corso</label>
                        <input type="text" class="form-control" id="corso" name="corso" 
                        <?php if(isset($_SESSION['corso'])) : ?> value ="<?php echo $_SESSION['corso']; ?>" <?php endif ?> required>
                    </div>
                    <div class="mb-3">
                        <label for="documenti" class="form-label">Documenti</label>
                        <input class="form-control" type="file" id="documenti"  name="documenti" multiple required>
                    </div>
                    <p class=""><strong>Nota: </strong>Sono permessi solo i formati .pdf, .doc, .docx, .jpeg, .jpg e .txt con una dimensione massima di 5mb</p> 
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg mt-4">Inserisci</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>

<?php get_footer() ?>
    