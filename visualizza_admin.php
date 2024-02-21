<?php

include_once 'inc/config.php';
include_once 'inc/db.config.php';

$sql = "SELECT * FROM pratiche";

$stmt = $conn -> prepare($sql);

if ($stmt -> execute() === FALSE ) {
    die('NON POSSO LEGGERE LE PRATICHE NEL DATABASE' . $stmt -> error);
};

$risultati = $stmt -> get_result();

if( $risultati -> num_rows > 0 ) { ?>

<main class="site-content">

    <div class="container py-5">

    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID pratica</th>
      <th scope="col">Corso</th>
      <th scope="col">Documenti</th>
      <th scope="col">Nome utente</th>
      <th scope="col">Responsabile pratica</th>
      <th scope="col">Stato pratica</th>
      <th scope="col">Data</th>
      <th scope="col">Gestione</th>
    </tr>
  </thead>
  <tbody>

  <?php while ( $riga = $risultati -> fetch_assoc() ) : ?>


    <tr>
      <th scope="row"><?php echo $riga['id']; ?></th>
      <td><?php echo $riga['corso']; ?></td>
      <td><?php echo $riga['documenti']; ?></td>
      <td><?php echo $riga['nome_utente']; ?></td>
      <td><?php echo $riga['responsabile_pratica']; ?></td>
      <td><?php echo $riga['stato_pratica']; ?></td>
      <td><?php echo $riga['data_inserimento']; ?></td>
      <td><a href="single.php?idpratiche=<?php echo $riga['id']; ?>" class="btn btn-success">VISUALIZZA</a><a href="../delete/index.php?idpratiche=<?php echo $riga['id']; ?>" class="btn btn-danger">CANCELLA</a> <a href="../update/index.php?idpratiche=<?php echo $riga['id']; ?>" class="btn btn-warning">AGGIORNA</a></td>
    </tr>

    <?php endwhile; ?>
   
    </tbody>
</table>


</main>


<?php } else {
    echo"non ci sono pratiche";
}

?>


<?php


