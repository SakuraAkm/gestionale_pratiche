<?php

include_once 'inc/config.php';
include_once 'inc/db.config.php';


$id = $_GET['idpratiche'];

$sql = "SELECT * FROM pratiche WHERE id=?";

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
            
               <section id="copertina" style="background-image: url(../../assets/images/);background-size: cover;background-position: center;height: 90vh;"class=" w-100 d-flex justify-content-center align-items-center text-white text-center">
            <div class="contenuto">
            <h2 class="display-1 text-uppercase fw-bold"><?php echo $riga['corso']; ?></h2>
                <p class="fs-1"><?php echo $riga['documenti']; ?></p>
                <p class="fs-5">Articolo scritto da:<?php echo $riga['nome_utente']; ?></p>
                <p class="fs-5">Articolo supervisionato da:<?php echo $riga['nome_responsabile']; ?></p>
                <p class="fs-5">Articolo creato il giorno:<?php echo $riga['data_registrazione']; ?></p>
           <a href="visualizza_admin?idpratiche=<?php echo $riga['id']; ?>" class="btn btn-warning">MODIFICA PRATICA</a>
         </div>

      
 


       




<?php } else {

echo "Non ci sono dati";

}


 
 $stmt->close();
 $conn->close();

 ?> 
   </section>
 



 </main>   