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
        $vd->setPagina(isset($request['page']));
        $this->setImpToken($vd, $request);
        echo 'ciao<br>';
        //Funzione logout
        if(isset($request["logout"]))
        {
            $this->logout($vd);
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
    }
}
?>