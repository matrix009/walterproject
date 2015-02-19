<p>
    <b>Aggiungi prodotto al database:</b>
    <br>
    <i>Tramite questa funzione è possibile aggiungere un prodotto al database!<br>
       Compilate i form e selezionate il tipo di prodotto che volete creare, poi cliccate sul pulsante "Aggiungi Al Database".</i>
</p>
<br>
<table style="text-align: left; width: 100%;" id="tabella_prodotti" align="center" cellpadding="0" cellspacing="0"><tr><td></td><td>
                    <table id="table_title" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td> 
                            </td>
                            <td>
                                <b>
                                    <select name="sezioni">
                                        <option value="none">Scheda Madre</option>
                                        <option value="none">CPU</option>
                                        <option value="none">RAM</option>
                                        <option value="none">Alimentatore</option>
                                        <option value="none">Case</option>
                                        <option value="none">Hard Disk</option>
                                    </select>
                                </b>                             
                            </td>
                            <td>
                            </td>
                        </tr>
                    </table>    
                    </td><td></td></tr><tr><td></td><td>
                    <table style="text-align: left; width: 100%;" cellpadding="5" cellspacing="1">

                        <tr title="Prodotto">
                            <td id="tabella_1"><b>Marca:</b> <input type="text" value="Scrivi la marca" size="22" maxlenght="50"></td>
                            <td id="tabella_2" colspan="1" rowspan="3"><b>Descrizione:</b> <textarea name="testo" rows="5" cols="45">Scrivi la descrizione</textarea></td>
                        </tr>

                        <tr title="Nome">
                            <td id="tabella_1"><b>Nome:</b> <input type="text" value="Scrivi il nome" size="22" maxlenght="50"></td>
                        </tr>

                        <tr title="Quantità">
                            <td id="tabella_1"><b>Quantità:</b> <input type="text" value="Qt." size="5" maxlenght="50"></td>
                        </tr>

                        <tr title="Prezzo">
                            <td id="tabella_3"><b>Prezzo:</b> <input type="text" value="Prezzo" size="5" maxlenght="50"> €</td>
                            <td id="tabella_2" colspan="1" rowspan="3">
                            <center>
                                <form action="index.php" method="post">
                                    <button id="bottone_carrello" type="submit" name="aggiungi_prod_database" value="null">Aggiungi Al Database</button>
                                </form>
                            </center>
                        </tr>

                    </table>
                </table>