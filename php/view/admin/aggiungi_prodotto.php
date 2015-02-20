<p>
    <b>Aggiungi prodotto al database:</b>
    <br>
    <i>Tramite questa funzione è possibile aggiungere un prodotto al database!<br>
       Compilate i form e selezionate il tipo di prodotto che volete creare, poi cliccate sul pulsante "Aggiungi Al Database".</i>
</p>
<br>
<center>
    <form method="post" action="index.php">
        <table id="tabella_aggiunta_prodotto">
            <tr>
                <td><b>Tipo:</b></td>

                <td>
                    <select name="tipo">
                        <option name="tipo">Scheda Madre</option>
                        <option name="tipo">CPU</option>
                        <option name="tipo">RAM</option>
                        <option name="tipo">Alimentatore</option>
                        <option name="tipo">Case</option>
                        <option name="tipo">Hard Disk</option>
                    </select>
                </td>
                </tr>

                <tr>
                    <td><b>Marca:</b></td>
                    <td>
                        <input type="text" name="marca" placeholder="Inserire la marca"/>
                    </td>
                </tr>

                <tr>
                    <td><b>Nome:</b></td>
                    <td>
                        <input type="text" name="nome" placeholder="Inserire il nome"/>
                    </td>
                </tr>

                <tr>
                    <td><b>Descrizione:</b></td>
                    <td>
                        <textarea type="text" name="descrizione" placeholder="Inserire una descrizione" rows="5" cols="40"></textarea>
                    </td>
                </tr>

                <tr>
                    <td><b>Quantità:</b></td>
                    <td>
                        <input type="text" name="quantita" placeholder="Inserira una quantità"/>
                    </td>
                </tr>

                <tr>
                    <td><b>Prezzo:</b></td>
                    <td>
                        <input type="text" name="prezzo" placeholder="Inserire un prezzo"/>
                    </td>
                </tr>

                <tr>
                    <td colspan="4" rowspan="3">
                        <br>
                        <hr>
                        <center><input id="bottone_carrello" type="submit" name="aggiungi_prod_database" value="Aggiungi al database"/></center>
                    <td>
                </tr>
        </table>
    </form>
</center>