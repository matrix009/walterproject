<?php

//Richiamo i file che ci servono
include_once 'BaseContr.php';
include_once basename(__DIR__) . '/../model/GuestDatabase.php';
include_once basename(__DIR__) . '/../model/guest.php';

//Creo il controller per admin
class AdminContr extends BaseContr 
{
    const appelli = 'appelli';

    public function __construct() 
    {
        parent::__construct();
    }
    
    //Richiamo le funzioni degli input da parte dell'utente
    public function listenInput(&$request) 
    {
        $vd = new ViewDescriptor();
        
        //Funzione logout
        if(isset($request["logout"]))
        {
            $this->logout($vd);
        }
        
        //Funzione carrello, aggiunge il prodotto e carica la pagina carrello
        if(isset($request["carrello"]))
        {
            $user = GuestDatabase::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);  
            ViewProdDatabase::instance()->saveUserAndProduct($user->getId(), $request["carrello"]); 
            $vd->setSottoPagina("carrello");
        }
        //Elimina il prodotto dal carrello e resta nella sottopagina carrello    
        if(isset($request["elimina_prodotto"]))
        { 
            ViewProdDatabase::instance()->cancellaProdottoDaCarrello($request["elimina_prodotto"]); 
            $vd->setSottoPagina("carrello");
        }
        //Questa funzione serve per eliminare il prodotto dal database    
        if(isset($request["elimina_prod_database"]))
        { 
            ViewProdDatabase::instance()->cancellaProdottoDaDatabase($request["elimina_prod_database"]); 
            $vd->setSottoPagina("home");
        }
        //Questa funzione serve per modificare il prodotto dal database    
        if(isset($request["aggiungi_prod_database"]))
        { 
            ViewProdDatabase::instance()->aggiungiProdottoAlDatabase($request["tipo"],
                                                                     $request["marca"],
                                                                     $request["nome"],
                                                                     $request["descrizione"],
                                                                     $request["quantita"],
                                                                     $request["prezzo"]);
            $vd->setSottoPagina("home");
        }
        $this->showHomeUtente($vd);
    }
}
?>
