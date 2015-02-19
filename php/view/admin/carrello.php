<p>
            <b>Carrello:</b>
            <br>
            <i>Questa pagina contiene i prodotti selezionati nella pagina precedente. E' possibile vedere i prodotti in modo tale
            da eliminarli in caso abbiate sbagliato, o di procedere semplicemente all'acquisto di quello selezionato.</i>
</p>
<table id="tabella_carrello">
    <tr><!--RIGA1-->
        <td><b>Carrello</b></td>
        <td align="center"><b>Descrizione</b></td>
        <td align="right"><b>Prezzo</b></td>
    </tr>
</table>
<?php

include_once basename(__DIR__) . '/../model/GuestDatabase.php';
include_once basename(__DIR__) . '/../model/ViewProdDatabase.php';

$cont = 0;

$user = GuestDatabase::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);

$result = ViewProdDatabase::instance()->loadCart($user->getId());

    foreach($result as $row)
            {
                ?>
                <table id="tabella_carrello2" align="center" style="text-align: left; width: 100%;" cellpadding="0" cellspacing="0"><tr><td class="mleft_top"></td><td><table class="mback" width="100%" cellpadding="0" cellspacing="0"><tr><td class="mback_left"></td><td class="mback_center">
                    </td><td class="mback_right"></td></tr></table></td><td class="mright_top"></td></tr><tr><td class="mleft"></td><td><table class="mainbg" style="text-align:center;width:100%" cellpadding="4" cellspacing="1">

                    <tr title="Prodotto">
                        <td id="carrello_1"><?= $row->getTipo() ?><br><?= $row->getNome() ?></td>
                        <td id="carrello_2"><?= $row->getDescrizione() ?></td>
                        <td id="carrello_3"><?= $row->getPrezzo() ?> €</td>
                    </tr>

                    <tr title="Rimuovi dal carrello">
                        <td colspan="3" rowspan="2">
                            <form action="index.php" method="post">
                                <button id="bottone_carrello" type="submit" name="elimina_prodotto" value="<?= $row->getIdCarrello() ?>">Cancella dal carrello</button>
                            </form>
                        </td>
                    </tr>
                </table>
                </table>
                <hr>
            <?php   
            $cont = $cont + $row->getPrezzo();
            }
?>
                <br>
<center>
    <div id="box_acquisto">
        <font size="3px"><b>Spesa Totale:</b></font> <font color="red" size="4px"><b><?= $cont ?> €</b></font><br>
        <i>Manca poco..</i>
        <form action="index.php">    
            <button id="submit" type="submit" name="sottopagina" value="transazione">Procedi All'cquisto!</button>
        </form>
        <hr>
        <form action="index.php">
            Oppure torna alla<button style="border: none; background: none;" type="submit" name="sottopagina" value="home"><u><font color="#3151A2">Home</font></u></button>
        </form>
    </div>
    <br>
    <font color="gray" style="box-shadow: 0 0 10px rgba(0,0,0,.2);">
        <i>Grazie per aver acquistato.<br>
           Pagamenti sicuri tramite Paypal.</i>
    </font>
</center>