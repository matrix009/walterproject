<br>
<div id="cssmenu">
    <ul>
        <li class="active">
            <form action="index.php">
                <button style="border: none; background: none;" type="submit" name="sottopagina" value="home">Home</button>
            </form>
            </li>
            <li>
            <form action="index.php">    
                <button style="border: none; background: none;" type="submit" name="sottopagina" value="carrello">Carrello</button>
            </form>
            </li>
            <li>
            <form action="index.php">    
                <button style="border: none; background: none;" type="submit" name="sottopagina" value="informazioni">Informazioni</button>
            </form>
            </li>
    </ul>
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
    <b>Benvenuto Admin!</b> Questa è la pagina principale dove potrete effettuare le operazioni consentite all'Admin.
</p>
</div>
<center>
    <input type="button" value="Clicca per far sparire/ricomparire" onClick="script2()" />
</center>