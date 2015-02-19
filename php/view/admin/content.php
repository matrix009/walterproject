<?php
    switch ($vd->getSottoPagina()) 
    {
        case 'carrello':
            include 'carrello.php';
            break;
        
        case 'informazioni':
            include 'informazioni.php';
            break;
        
        case 'modifica':
            include 'modifica.php';
            break;
        
        case 'aggiungi_prodotto':
            include 'aggiungi_prodotto.php';
            break;
        
        case 'transazione':
            include 'transazione.php';
            break;

        default: ?>
        <p>
            <b>Visualizzazione prodotti disponibili:</b>
            <br>
            <i>Questa lista contiene i prodotti disponibili nel database. E' possibile aggiungerli al carrello per poterli acquistare tramite l'apposito bottone.
            Una volta effettuato il click si verrà reindirizzati automaticamente al carrello. Buon acquisto!</i>
        </p>
        <br>
        <?php
            include_once basename(__DIR__) . "/../model/ViewProdDatabase.php"; 
            $result = ViewProdDatabase::instance()->caricaProdDatabase();
		
            while($row = $result->fetch_object())
            {
                ?>
                <table style="text-align: left; width: 100%;" id="tabella_prodotti" align="center" cellpadding="0" cellspacing="0"><tr><td></td><td>
                    <table id="table_title" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td> 
                            </td>
                            <td>
                                <b><?= $row->tipo ?></b>                             
                            </td>
                            <td align="right" style="padding-right: 10px;">
                                <form action="index.php" method="post"><button id="bottone_cancella_modifica" type="submit" name="sottopagina" value="modifica"><b>Modifica</b></button> |<button id="bottone_cancella_modifica" type="submit" name="elimina_prod_database" value="<?= $row->id_prodotto ?>"><b>Cancella</b></button></form>                            
                            </td>
                            <td>
                            </td>
                        </tr>
                    </table>    
                    </td><td></td></tr><tr><td></td><td>
                    <table style="text-align: left; width: 100%;" cellpadding="5" cellspacing="1">

                        <tr title="Prodotto">
                            <td id="tabella_1"><b>Marca:</b> <?= $row->marca ?></td>
                            <td id="tabella_2" colspan="1" rowspan="3"><b>Descrizione:</b> <?= $row->descrizione ?></td>
                        </tr>

                        <tr title="Nome">
                            <td id="tabella_1"><b>Nome:</b> <?= $row->nome ?></td>
                        </tr>

                        <tr title="Quantità">
                            <td id="tabella_1"><b>Quantità:</b> <?= $row->quantita ?></td>
                        </tr>

                        <tr title="Aggiungi al carrello">
                            <td id="tabella_3"><b>Prezzo:</b> <?= $row->prezzo ?> €</td>
                            <td id="tabella_2" colspan="1" rowspan="3"><center>
                                <form action="index.php" method="post">
                                    <button id="bottone_carrello" type="submit" name="carrello" value="<?= $row->id_prodotto ?>">Aggiungi al carrello</button>
                                    <!--<a href=<?//= $row->id_prodotto?>>Aggiungi al carrello</a>-->
                                </form></center>
                            </td>
                        </tr>

                    </table>
                </table>
                <br>
                <?php               
            }  
        break;
    }
?>