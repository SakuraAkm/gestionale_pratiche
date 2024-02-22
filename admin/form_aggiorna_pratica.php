<?php
include_once '../inc/db.config.php';
include_once '../inc/functions.php';
get_header("Aggiorna Pratica");

$id = $_GET['idpratiche'];

$sql = "SELECT * FROM pratiche WHERE id_pratica=?";

$stmt = $conn -> prepare($sql);
$stmt -> bind_param('i', $id);

if( $stmt -> execute() === FALSE){
    die("Error". $stmt -> error);
}

$results = $stmt -> get_result();
$row = $results -> fetch_assoc();  
?>

<main>
    <section class="min-height d-flex justify-content-center align-items-center">
        <form action="aggiorna.php" method="POST">
            <h1 class="fs-1 text-center text-uppercase fw-semibold">Aggiorna Dati Pratica</h1>
            <div class="container position-relative py-5 d-flex justify-content-center align-items-center">
                <div>
                    <div class="mb-3">
                        <label for="aggiorna-corso" class="form-label">Corso</label>
                        <input type="text" class="form-control" id="aggiorna-corso" name="aggiorna-corso" value="<?php echo $row['corso'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="aggiorna-nome-utente" class="form-label">Nome Utente</label>
                        <input type="text" class="form-control" id="aggiorna-nome-utente" name="aggiorna-nome-utente" value="<?php echo $row['nome_utente'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="aggiorna-nome-responsabile" class="form-label">Nome Responsabile</label>
                        <input type="text" class="form-control" id="aggiorna-nome-responsabile" name="aggiorna-nome-responsabile" value="<?php echo $row['nome_responsabile'] ?>">
                    </div>
                    <!-- bisogna fare un menu a tendina dove selezionare lo stato, e fare in modo che invii a aggiorna.php / riceva un integer
                    <div class="mb-3">
                        <label for="aggiorna-stato" class="form-label">Stato</label>
                        <input type="text" class="form-control" id="aggiorna-stato" name="aggiorna-stato" value="<?php echo $row['stato'] ?>">
                    </div> 
                    -->
                    <div class="mb-3">
                        <label for="aggiorna-documenti" class="form-label">Documento</label>
                        <input type="file" class="form-control" id="aggiorna-documenti"  name="aggiorna-documenti" multiple value="<?php echo $row['documenti'] ?>">
                    </div>

                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="text-center">
                        <button type="submit" class="btn btn-warning btn-lg mt-2">Aggiorna</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</main>

<?php get_footer();

$conn->close();
$stmt->close();
?>
    