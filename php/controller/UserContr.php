<?php
//Includo i file necessari
include_once 'BaseContr.php';
include_once basename(__DIR__) . '/../model/ViewProdDatabase.php';

//Creo il controller per l'utente normale
class UserContr extends BaseContr 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function listenInput(&$request) 
    {
        $vd = new ViewDescriptor();
        $vd->setPagina(isset($request['page']));
        $this->setImpToken($vd, $request);
        
        //Nel caso venga richiesto il logout
        if(isset($request["logout"]))
        {
            $this->logout($vd);
        }
        //Questa funzione salva il prodotto selezionato all'interno del carrello dell'utente
        if(isset($request["carrello"]))
        {
            $user = GuestDatabase::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);  
            ViewProdDatabase::instance()->saveUserAndProduct($user->getId(), $request["carrello"]); 
            $vd->setSottoPagina("carrello");
        }

        // Funzione che elimina il prodotto scelto nel carrello
        if(isset($request["elimina_prodotto"]))
        { 
            ViewProdDatabase::instance()->cancellaProdottoDaCarrello($request["elimina_prodotto"]); 
            $vd->setSottoPagina("carrello");
        }

        // Funzione che fa terminare l'acquisto con la cancellazione dei prodotti dal carrello
        if(isset($request["svuota_carrello"]))
        { 
            $user = GuestDatabase::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);  
            ViewProdDatabase::instance()->transazioneCarrello($request["svuota_carrello"]); 
            $vd->setSottoPagina("transazione");
        }
        //Gestione sottopagine da parte dell'utente
        if(isset($request["sottopagina"]))
        {                
            switch($request["sottopagina"])
            {
                case 'carrello':
                    $vd->setSottoPagina('carrello');
                    break;

                case 'informazioni':
                    $vd->setSottoPagina('informazioni');
                    break;

                case 'transazione':
                    $vd->setSottoPagina('transazione');
                    break;

                case 'modifica':
                    $vd->setSottoPagina('modifica');
                    break;

                case 'aggiungi_prodotto':
                    $vd->setSottoPagina('aggiungi_prodotto');
                    break;
            }

        }
        $this->showHomeUtente($vd);
    }
}
?>