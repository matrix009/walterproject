<?php
    include_once basename(__DIR__) . '/../model/GuestDatabase.php';
    $user = GuestDatabase::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
?>

<form method="post" action="index.php">
    <input class="styled-buttom" id="logout" type="submit" name="logout" value="Logout"/><b> | <?= $user->getUserName() ?></b>
</form>
