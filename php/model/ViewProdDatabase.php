<?php
//Classe che richiama i prodotti dal database
class ViewProdDatabase 
{
    private static $singleton;
    
    private function __constructor()
    {
        
    }

    public static function instance()
    {
        if(!isset(self::$singleton))
        {
            self::$singleton = new ViewProdDatabase();
        }       
        return self::$singleton;
    }
    //Funzione che richiama i prodotti presenti all'interno del database
    public function caricaProdDatabase()
    {        
        $mysqli = Database::connettiDatabase();
        
        if (!isset($mysqli)) {
            error_log("[cercaAppelloPerId] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        $query = "SELECT * FROM prodotto";
        $result = $mysqli->query($query);
        $mysqli->close();
        
        return $result;
    }
    //Funzione che salva i prodotti per metterli nel carrello
    public function saveUserAndProduct($id_utente, $id_prodotto)
    { 
        $mysqli = Database::connettiDatabase();
        if (!isset($mysqli))
        {
            error_log("[saveUserAndProduct] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        $query = "INSERT INTO carrello (id_utente, id_prodotto) VALUES (?, ?)";

        $precomp = $mysqli->stmt_init();
        $precomp->prepare($query);
        if (!$precomp) 
        {
            error_log("[saveUserAndProduct] impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$precomp->bind_param('ii', $id_utente, $id_prodotto)) 
        {
            error_log("[saveUserAndProduct] impossibile effettuare il binding in input");
            $mysqli->close();
            return null;
        }

        $precomp->execute();
        $precomp->close();       
    }
    //Questa funzione serve per vedere cosa si trova dentro il carrello
    public function &loadCart($id_utente)
    {
        $mysqli = Database::connettiDatabase();
        if (!isset($mysqli))
        {
            error_log("[loadCart] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }
        $query = "SELECT prodotto.*, carrello.id_carrello FROM carrello JOIN prodotto WHERE carrello.id_utente = ? and carrello.id_prodotto = prodotto.id_prodotto";
        $precomp = $mysqli->stmt_init();
        $precomp->prepare($query);
        if (!$precomp) 
        {
            error_log("[loadCart] impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$precomp->bind_param('i', $id_utente)) 
        {
            error_log("[loadCart] impossibile effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        $prodotto =  self::caricaProdottoDaStmt($precomp);
        if (isset($prodotto))
        {
            $mysqli->close();
            return $prodotto;
        }
    }
    //Carico la struttura del prodotto dal database
    private function &caricaProdottoDaStmt(mysqli_stmt $precomp) 
    {
        $prodotti = array();
        if (!$precomp->execute())
        {
            error_log("[caricaProdottotoDaStatementt] Impossibile eseguire lo statement");
            return null;
        }
        $row = array();
        $bind = $precomp->bind_result(
                $row['prodotto.id_prodotto'], 
                $row['prodotto.tipo'], 
                $row['prodotto.marca'], 
                $row['prodotto.nome'], 
                $row['prodotto.descrizione'], 
                $row['prodotto.quantita'], 
                $row['prodotto.prezzo'],
                $row['carrello.id_carrello']);
        if (!$bind)
        {
            error_log("[caricaProdottoDaStmt] impossibile effettuare il binding in output");
            return null;
        }
        
        //row contiene una tupla, prodotti contiene tutte le tuple
        while ($precomp->fetch()) 
        {
            $prodotti[] = self::creaProdottoDaArray($row);
        }

        $precomp->close();
        
        return $prodotti;
    }
    //Associo le funzioni alla struttura del prodotto
    public function creaProdottoDaArray($row) 
    {
        $prodotto = new Prodotto();
        $prodotto->setIdProdotto($row['prodotto.id_prodotto']);
        $prodotto->setIdCarrello($row['carrello.id_carrello']);
        $prodotto->setTipo($row['prodotto.tipo']);
        $prodotto->setMarca($row['prodotto.marca']);
        $prodotto->setNome($row['prodotto.nome']);
        $prodotto->setDescrizione($row['prodotto.descrizione']);
        $prodotto->setQuantita($row['prodotto.quantita']);
        $prodotto->setPrezzo($row['prodotto.prezzo']);  
 
        return $prodotto;
    }
    //Funzione che permette di eliminare il prodotto dal carrello
    public function cancellaProdottoDaCarrello($id_carrello)
    {
        $mysqli = Database::connettiDatabase();
        if (!isset($mysqli))
        {
            error_log("[saveUserAndProduct] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        $query = "DELETE FROM carrello WHERE carrello.id_carrello = ?";
        
        $precomp = $mysqli->stmt_init();
        $precomp->prepare($query);
        if (!$precomp) 
        {
            error_log("[saveUserAndProduct] impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$precomp->bind_param('i', $id_carrello)) 
        {
            error_log("[saveUserAndProduct] impossibile effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        
        $precomp->execute();
        $precomp->close();  
    }
    //Funzione che permette di eliminare l'intero prodotto dal database
    public function cancellaProdottoDaDatabase($id_prodotto)
    {
        $mysqli = Database::connettiDatabase();
        if (!isset($mysqli))
        {
            error_log("[saveUserAndProduct] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        $query = "DELETE FROM prodotto WHERE prodotto.id_prodotto = ?";
        
        $precomp = $mysqli->stmt_init();
        $precomp->prepare($query);
        if (!$precomp) 
        {
            error_log("[saveUserAndProduct] impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$precomp->bind_param('i', $id_prodotto)) 
        {
            error_log("[saveUserAndProduct] impossibile effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        
        $precomp->execute();
        $precomp->close();  
    }
    //Funzione che permette di modificare l'intero prodotto del database
    public function aggiungiProdottoAlDatabase($id_prodotto)
    {
        $mysqli = Database::connettiDatabase();
        if (!isset($mysqli))
        {
            error_log("[aggiungiProdottoAlDatabase] impossibile inizializzare il database");
            $mysqli->close();
            return null;
        }

        $query = "";
        
        $precomp = $mysqli->stmt_init();
        $precomp->prepare($query);
        if (!$precomp) 
        {
            error_log("[aggiungiProdottoAlDatabase] impossibile inizializzare il prepared statement");
            $mysqli->close();
            return null;
        }

        if (!$precomp->bind_param('i', $id_prodotto)) 
        {
            error_log("[aggiungiProdottoAlDatabase] impossibile effettuare il binding in input");
            $mysqli->close();
            return null;
        }
        
        $precomp->execute();
        $precomp->close();  
    }
}
?>