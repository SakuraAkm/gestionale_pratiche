<?php

    include_once 'inc/functions.php';
    include_once 'inc/db.config.php';

    get_header("Visualizza Pratiche"); 

    $sql = "SELECT * FROM pratiche";

    $stmt = $conn -> prepare($sql);

    if ( $stmt -> execute() === FALSE ) {
        die('NON POSSO LEGGERE LE PRATICHE NEL DATABASE' . $stmt -> error );
    }

    $risultati = $stmt -> get_result();

?>

    <main class="text-dark">
        <section class="min-height">
            
            <div class="container table-responsive">
                <h1 class="display-4 fw-semibold text-center py-5">Pratiche registrate</h1>
                <?php if ( $risultati -> num_rows > 0 ) { ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr class="fs-4 text-center">
                            <th scope="col">Corso</th>
                            <th scope="col">Documenti</th>
                            <th scope="col">Utente</th>
                            <th scope="col">Responsabile</th>
                            <th scope="col">Stato Pratica</th>
                            <th scope="col">Data Registrazione</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ( $riga = $risultati -> fetch_assoc() )  :?>       
                            <tr class="text-center"> 
                                    <td> <?php echo $riga['corso']; ?> </td>
                                    <td> <?php 
                                        if(!empty($riga['documenti']))
                                            echo 'presente'; 
                                        ?>
                                    </td>
                                    <td> <?php echo $riga['nome_utente']; ?> </td>
                                    <td>
                                        <?php 
                                            if(!empty($riga['nome_responsabile']))
                                                echo $riga['nome_responsabile']; 
                                            else
                                                echo "Responsabile non assegnato";
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        if($riga['stato_pratica'] == 1)
                                            echo 'presa in carica'; 
                                        elseif($riga['stato_pratica'] == 2)
                                            echo 'in lavorazione';
                                        elseif($riga['stato_pratica'] == 3)
                                            echo 'completata';
                                        ?>
                                    </td>
                                    <td><?php //echo $riga['data_registrazione']; 
                                        $data_registrazioneDB = strtotime($riga['data_registrazione']); 
                                        $data_visualizzata = date('j F Y H:i:s', $data_registrazioneDB);
                                        echo $data_visualizzata;?>
                                    </td>
                            </tr>
                        <?php endwhile; ?>            
                    </tbody>
                </table>
            </div>
        </section>
        
        <?php } else {?>

        <main>
            <section>
                <h1 class= "fs-3 fw-medium d-flex justify-content-center align-items-center pt-5">
                    <?php echo "Nessuna Praticha Registrata"; ?> 
                </h1>
            </section>
        </main>

    <?php } ?>

    </main>

    <?php

    get_footer(); 

    $stmt->close();
    $conn->close();
    ?>
    