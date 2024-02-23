<?php

include_once 'inc/config.php';
include_once 'inc/db.config.php';
include_once 'inc/functions.php';
get_header("Admin - Visualizza");

if($_SESSION['login'] == false)
{
    header('location: index.php');
    exit;
}

$sql = "SELECT * FROM pratiche";

$stmt = $conn -> prepare($sql);

if ($stmt -> execute() === FALSE ) {
    die('NON POSSO LEGGERE LE PRATICHE NEL DATABASE' . $stmt -> error);
};

$risultati = $stmt -> get_result();

if( $risultati -> num_rows > 0 ) { ?>

<main class="site-content min-height container2">

  <h1 class="display-4 fw-semibold text-center py-5">Pratiche registrate</h1>

  <table class="table table-striped table-hover">
    <thead>
      <tr class="fs-5 text-center">
        <th scope="col">ID</th>
        <th scope="col">Corso</th>
        <th scope="col">Documenti</th>
        <th scope="col">Utente</th>
        <th scope="col">Responsabile</th>
        <th scope="col">Stato pratica</th>
        <th scope="col">Data Registrazione</th>
        <th scope="col">Gestione</th>
      </tr>
    </thead>
    <tbody>

  <?php while ( $riga = $risultati -> fetch_assoc() ) : ?>


    <tr class="text-center">
      <th scope="row"><?php echo $riga['id_pratica']; ?></th>
      <td><?php echo $riga['corso']; ?></td>
      <td><?php echo $riga['documenti']; ?></td>
      <td><?php echo $riga['nome_utente']; ?></td>
      <td><?php echo $riga['nome_responsabile']; ?></td>
      <td>

      <?php 
        if($riga['stato_pratica'] == 1){
          echo 'Presa in Carica';
        } elseif($riga['stato_pratica'] == 2){
          echo 'In corso';
        } elseif($riga['stato_pratica'] == 3){
          echo 'Completata';
        } else {echo "Error"; }; ?>

      </td>
      <td><?php echo $riga['data_registrazione']; ?></td>
      <td class="text-center">
        <a href="admin/visualizza.php?idpratiche=<?php echo $riga['id_pratica']; ?>" class="btn btn-success">VISUALIZZA</a>
        <a href="admin/cancella.php?idpratiche=<?php echo $riga['id_pratica']; ?>" class="btn btn-danger mx-1">CANCELLA</a> 
        <a href="admin/form_aggiorna_pratica.php?idpratiche=<?php echo $riga['id_pratica']; ?>" class="btn btn-warning">AGGIORNA</a>
      </td>
    </tr>

    <?php endwhile; ?>
   
    </tbody>
</table>


</main>


<?php } else { ?>

  <main class="min-height">
      <h1 class="display-4 fw-semibold text-center pt-5">Pratiche registrate</h1>
    <div>

      <h1 class= "fs-3 fw-medium d-flex justify-content-center align-items-center pt-5">
        <?php echo "Nessuna Praticha Registrata"; ?> 
      </h1>

    </div>
  </main>

<?php 
}

get_footer(); 

?>