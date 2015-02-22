<?php 
    include_once 'controller/BaseContr.php';
    include_once 'controller/UserContr.php';
    include_once 'controller/AdminContr.php';
    include_once 'model/prodotto.php';

    date_default_timezone_set("Europe/Rome");

    ControllerPrincipale::dispatch($_REQUEST);

    class ControllerPrincipale 
    {
        public static function dispatch(&$request) 
        {            
            session_start(); 
            
            //Richiama l'eliminazione del prodotto dal database
            if(isset($request["elimina_prod_database"])) 
            {
                $cont = new AdminContr();
                $cont->listenInput($request);
            }
            //Richiama l'aggiunta del prodotto dal database
            if(isset($request["aggiungi_prod_database"])) 
            {
                $cont = new AdminContr();
                $cont->listenInput($request);
            }
            
            if(isset($request["logout"]))
            {
                if($request["logout"] === 'Logout') 
                {
                    $cont = new BaseContr();
                    $cont->listenInput($request);
                }
            }
            else
            {   // Questo test mi permette di determinare se un utente è già loggato nel sito
                // Se è già loggato faccio la ricerca e determino che tipo di utente è
                if(isset($_SESSION['role']))
                {
                    switch($_SESSION['role'])
                    {
                        // Caso utente
                        case '1':
                            $cont = new UserContr();
                            $cont->listenInput($request); 
                            break;
                        // Caso amministratore
                        case '2':
                            $cont = new AdminContr();
                            $cont->listenInput($request);
                            break;
                    }
                }
                else   
                {
                    $cont = new BaseContr();
                    $cont->listenInput($request);            
                }
            }
        }
    }
?>