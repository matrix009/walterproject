<?php
    switch ($vd->getSottoPagina()) 
    {        
        case 'informazioni':
            include 'informazioni.php';
            break;

        default: ?>
                <br><br><br><br><br><br>
                <br><br><br><br><br><br>
                <div id="box_login">
                    <form method="post" action="index.php" id="login">
                        <h1>Log In</h1>
                        <fieldset id="inputs">
                            <label for="user">Username</label>
                            <input id="username" type="text" name="user" id="user"/>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"/> 
                        </fieldset>
                        <fieldset id="actions">
                            <center><input id="submit" type="submit" name="cmd" value="Login"/></center>
                        </fieldset>
                    </form>
                </div>
                <br><br><br><br><br><br>
                <br><br><br><br>
                <?php               
        break;
    }
?>