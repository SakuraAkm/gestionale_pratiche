<?php

    include_once 'inc/functions.php';
    include_once 'inc/db.config.php';

    //get_header("Tutti gli articoli - Nome Sito Web"); 

    $sql = "SELECT * FROM pratiche";

    $stmt = $conn -> prepare($sql);

    if ( $stmt -> execute() === FALSE ) {
        die('NON POSSO LEGGERE LE PRATICHE NEL DATABASE' . $stmt -> error );
    }

    $risultati = $stmt -> get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <main class="site-content">
        <section class="pt-5">
            
            <div class="container">
            <h1 class="text-center p-3">Pratiche registrate</h1>
            <?php if ( $risultati -> num_rows > 0 ) { ?>
                <table class="table table-secondary">
                    <thead>
                        <tr>
                        <th scope="col">Corso</th>
                        <th scope="col">Documenti</th>
                        <th scope="col">Utente</th>
                        <th scope="col">Responsabile</th>
                        <th scope="col">Stato Pratica</th>
                        <th scope="col">Data Registrazione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                <?php while ( $riga = $risultati -> fetch_assoc() )  :?>
                            <td><?php echo $riga['corso']; ?></td>
                            <td>
                                <?php if(!empty($riga['documenti']))
                                    echo 'presente';
                             ?></td>
                            <td><?php echo $riga['nome_utente']; ?></td>
                            <td><?php echo $riga['nome_responsabile']; ?></td>
                            <td><?php 
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
                    </tbody>
                </table>
            <?php endwhile; ?>
            </div>
        </section>
        
        <?php } else {
            echo "non ci sono pratiche";
        }?>
    </main>
    <?php

    //get_footer("Sito creato da Matteo Mungari"); 

    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>