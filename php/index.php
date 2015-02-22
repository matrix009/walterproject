<?php 
    //Include i file necessari
    include_once 'controller/BaseContr.php';
    include_once 'controller/UserContr.php';
    include_once 'controller/AdminContr.php';
    include_once 'model/prodotto.php';

    date_default_timezone_set("Europe/Rome");

    ControllerPrincipale::dispatch($_REQUEST);
    //Dalla index indicizzo la pagina in base alla situazione
    class ControllerPrincipale 
    {
        public static function dispatch(&$request) 
        {            
            session_start(); 
            
            //Elimina prodotto dl database
            if(isset($request["elimina_prod_database"]))
            {
                $cont = new AdminContr();
                $cont->listenInput($request);
            }
            //Aggiunge prodotto da database
            if(isset($request["aggiungi_prod_database"]))
            {
                $cont = new AdminContr();
                $cont->listenInput($request);
            }
            
            //Gestisce il logout da parte degli utent loggati
            if (isset($request["logout"])) 
            {
                $controller = new UserContr();
                if (isset($_SESSION[BaseContr::role]) &&$_SESSION[BaseContr::role] != User::User) 
                {
                    self::write403();
                }
                $controller->listenInput($request);  
            }
            else
            {   
                if(isset($_SESSION['role']))
                {
                    switch($_SESSION['role'])
                    {   
                        case '1':
                            $cont = new UserContr();
                            $cont->listenInput($request); 
                            break;
                        
                        case '2':
                            $cont = new AdminContr();
                            $cont->listenInput($request);
                            break;
                    }
                }
                else   
                {   //Nel caso non vi sia login rimando al controller principale per il login
                    $cont = new BaseContr();
                    $cont->listenInput($request);            
                }
            }
        }
    }
?>