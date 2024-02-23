<?php

include_once '../inc/config.php';
include_once '../inc/db.config.php';
include_once '../inc/functions.php';
get_header("Pratica");

if($_SESSION['login'] == false)
{
    header('location: index.php');
    exit;
}


$id = $_GET['idpratiche'];

$sql = "SELECT * FROM pratiche WHERE id_pratica=?";

$stmt = $conn -> prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt -> execute() === FALSE ) {
    die('NON POSSO LEGGERE LE PRATICHE NEL DATABASE' . $stmt -> error);
};

$risultati = $stmt -> get_result();
$riga = $risultati -> fetch_assoc();

if( $risultati -> num_rows > 0 ) { 
?>
    
<main>
            
<section id="copertina" style="background-image: url(../../assets/images/);background-size: cover;background-position: center;height: 90vh;"
  class="min-height w-100 d-flex justify-content-center align-items-center text-center">

  <div class="contenuto">
    <h1 class="display-3">Corso di:</h1>
    <h1 class="display-3 text-uppercase fw-semibold"><?php echo $riga['corso']; ?></h1>

    <div class="mb-4">
      <a href="download_doc.php?path=<?php echo $riga['documenti']?>&id=<?php echo $riga['id_pratica'] ?>" class="download-documento fs-2 text-secondary">
        Download Documento
      </a>
    </div>

    <p class="fs-5">Corso di: <?php echo $riga['nome_utente']; ?></p>
    <p class="fs-5">Supervisionato da: <?php echo $riga['nome_responsabile']; ?></p>
    <p class="fs-5">Stato della pratica:
      <?php 

      if($riga['stato_pratica'] == 1){
        echo 'Presa in Carica';
      } elseif($riga['stato_pratica'] == 2){
        echo 'In corso';
      } elseif($riga['stato_pratica'] == 3){
        echo 'Completata';
      } else {echo "Error"; }; ?>

    </p>
    <p class="fs-5">Creata il giorno:   <?php echo $riga['data_registrazione']; ?></p>
    <a href="form_aggiorna_pratica.php?idpratiche=<?php echo $riga['id_pratica']; ?>" class="btn btn-warning">MODIFICA PRATICA</a>
  </div>

<?php } else { ?>

  <h1 class="display-4">
    <?php echo "Non ci sono dati"; ?>
  </h1> 

<?php
}
 ?> 
  </section>
 </main>   

 <?php 
 get_footer();
 
 $stmt->close();
 $conn->close();

 ?>