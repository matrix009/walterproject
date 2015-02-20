<br>
<div id="cssmenu">
    <form action="index.php">
    <ul>
        <li class="active"><button style="border: none; background: none;" type="submit" name="sottopagina" value="home">Home</button>
    </form>
    <form action="index.php">
        <li><button style="border: none; background: none;" type="submit" name="sottopagina" value="informazioni">Informazioni</button>
    </ul>
    </form>
</div>
<script>
function script2() {
    var e = document.getElementById("pippo");
    if (e.style.visibility == 'hidden') {
        e.style.visibility = 'visible';
        e.style.display = 'block';
    } else {
        e.style.visibility = 'hidden';
        e.style.display = 'none';
    }
}
</script>
<div id="pippo">
<p id="text_benvenuti">
    <b>Benvenuti!</b> Questa è la pagina principale dove potrete effettuare il login per poter accedere alle funzionalità del sito.
       Per conoscere maggiori informazioni, potete accedere alla pagina Informazioni tramite il menù qua sopra. Buona navigazione.
</p>
</div>
<center>
    <input type="button" value="Clicca per far sparire/ricomparire" onClick="script2()" />
</center>
<br><br><br><br><br><br><br><br><br><br>