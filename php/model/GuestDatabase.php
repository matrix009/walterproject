<?php
//Includo i file necessari
include_once 'guest.php';
include_once 'Database.php';

//Questa classe implementa tutte le richieste al database per l'utente
class GuestDatabase
{
    private static $singleton;
    private function __constructor() 
    {
        
    }

    public static function instance() 
    {
        if (!isset(self::$singleton)) 
        {
            self::$singleton = new GuestDatabase();
        }
        return self::$singleton;
    }
    //Carico i due utenti presenti nel database
    public function caricaUtente($username, $password) 
    {
        $mysqli = Database::connettiDatabase();
        if (!isset($mysqli)) 
        {
            error_log("[loadUser] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        //Cerco l'utente normale
        $query = "SELECT * FROM user WHERE user.username = ? AND user.password = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) 
        {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }
        if (!$stmt->bind_param('ss', $username, $password)) 
        {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        $user = self::caricaUserDaStmt($stmt);
        if (isset($user)) 
        {
            $mysqli->close();
            return $user;
        }
        
        //Ora cerco l'admin
        $query = "SELECT * FROM user WHERE user.username = ? AND user.password = ?";
        $stmt = $mysqli->stmt_init();
        $stmt->prepare($query);
        if (!$stmt) {
            error_log("[loadUser] impossibile" .
                    " inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$stmt->bind_param('ss', $username, $password)) {
            error_log("[loadUser] impossibile" .
                    " effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        $admin = self::caricaAdminDaStmt($stmt);
        if (isset($admin)) 
        {
            $mysqli->close();
            return $admin;
        }
    }
    //Questa funzione serve per distinguere l'utente e assegnarli il ruolo in base all'id
    public function cercaUtentePerId($id, $role) 
    {
        $intval = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if (!isset($intval)) 
        {
            return null;
        }
        $mysqli = Database::connettiDatabase();
        if (!isset($mysqli)) 
        {
            error_log("[cercaUtentePerId] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        switch ($id) 
        {
            //Caso utente
            case User::User:
                $query = "SELECT * FROM `user` WHERE id_utente = ?";
                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) 
                {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) 
                {
                    error_log("[cercaUtentePerId] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                return self::caricaUserDaStmt($stmt);
                break;
            //Caso admin
            case User::Admin:
                $query = "SELECT * FROM `user` WHERE id_utente = ?";
                $stmt = $mysqli->stmt_init();
                $stmt->prepare($query);
                if (!$stmt) 
                {
                    error_log("[cercaUtentePerId] impossibile" .
                            " inizializzare il prepared statement");
                    $mysqli->close();
                    return null;
                }

                if (!$stmt->bind_param('i', $intval)) 
                {
                    error_log("[cercaUtentePerId] impossibile" .
                            " effettuare il binding in input");
                    $mysqli->close();
                    return null;
                }

                return self::caricaAdminDaStmt($stmt);
                break;
        }
    }
    //Assegno le funzioni all'utente normale con il ruolo specificato
    public function creaUserDaArray($row) 
    {
        $user = new User();
        $user->setId($row['user.id_utente']);
        $user->setNome($row['user.nome']);
        $user->setCognome($row['user.cognome']);
        $user->setRuolo(User::User);
        $user->setUserName($row['user.username']);
        $user->setPassword($row['user.password']);
       
        return $user;
    }
    //Assegno le funzioni all'admin e il suo ruolo
    public function creaAdminDaArray($row) 
    {
        $admin = new User();
        $admin->setId($row['user.id_utente']);
        $admin->setNome($row['user.nome']);
        $admin->setCognome($row['user.cognome']);
        $admin->setRuolo(User::Admin);
        $admin->setUserName($row['user.username']);
        $admin->setPassword($row['user.password']);
        
        return $admin;
    }

    public function salva(User $user) {
        $mysqli = Database::connettiDatabase();
        if (!isset($mysqli)) {
            error_log("[salva] impossibile inizializzare il database");
            $mysqli->close();
            return 0;
        }

        $stmt = $mysqli->stmt_init();
        $count = 0;
        switch ($user->getRuolo()) {
            case User::User:
                $count = $this->salvaUser($user, $stmt);
                break;
            case User::Admin:
                $count = $this->salvaAdmin($user, $stmt);
        }

        $stmt->close();
        $mysqli->close();
        return $count;
    }
    //Carico la struttura utente dal database
    private function caricaUserDaStmt(mysqli_stmt $stmt) 
    {
        if (!$stmt->execute()) 
        {
            error_log("[caricaGuestDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }
        $row = array();
        $bind = $stmt->bind_result(
                $row['user.id_utente'], $row['user.nome'], $row['user.cognome'], $row['user.username'], $row['user.password'], $row['user.role']);
        if (!$bind) 
        {
            error_log("[caricaGuestDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }
        if (!$stmt->fetch()) 
        {
            return null;
        }
        $stmt->close();
        return self::creaUserDaArray($row);
    }
    //Carico la struttura admin dal database
    private function caricaAdminDaStmt(mysqli_stmt $stmt) {

        if (!$stmt->execute()) 
        {
            error_log("[caricaAdminDaStmt] impossibile" .
                    " eseguire lo statement");
            return null;
        }
        $row = array();
        $bind = $stmt->bind_result
        (
                $row['user.id_utente'], $row['user.nome'], $row['user.cognome'], $row['user.username'], $row['user.password'], $row['user.role']);
        if (!$bind) 
        {
            error_log("[caricaAdminDaStmt] impossibile" .
                    " effettuare il binding in output");
            return null;
        }
        if (!$stmt->fetch()) 
        {
            return null;
        }
        $stmt->close();
        return self::creaAdminDaArray($row);
    }
}
?>