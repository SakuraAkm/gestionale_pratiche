<?php
include_once '../inc/db.config.php';
include_once '../inc/functions.php';
get_header("Aggiorna Pratica");

if($_SESSION['login'] == false)
{
    header('location: index.php');
    exit;
}

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
        <form action="aggiorna.php" method="POST" enctype="multipart/form-data">
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

                    <label for="aggiorna-stato" class="form-label">Stato</label>
                    <select class="form-select mb-3" id="aggiorna-stato" name="aggiorna-stato" aria-label="Default select example">
                        <option selected>Stato della Pratica</option>
                        <option value="1" <?php echo $row['stato_pratica'] == 1 ? "selected" : null ?> >
                            Presa in Carica
                        </option>
                        <option value="2" <?php echo $row['stato_pratica'] == 2 ? "selected" : null ?>>
                            In Corso
                        </option>
                        <option value="3" <?php echo $row['stato_pratica'] == 3 ? "selected" : null?>>
                            Completata
                        </option>
                    </select>

                    <div class="mb-3">
                        <label for="documenti" class="form-label">Documento</label>
                        <input type="file" class="form-control" id="aggiorna-documenti"  name="documenti" multiple >
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
    