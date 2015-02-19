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
            
            if(isset($request["carrello"]))
            {
                $cont = new UserContr();
                $cont->listenInput($request); 
            }
            
            if(isset($request["sottopagina"]))
            {
                $cont = new UserContr();
                $cont->listenInput($request);
            }
            
            if(isset($request["elimina_prodotto"]))
            {
                $cont = new UserContr();
                $cont->listenInput($request);
            }

            if(isset($request["elimina_prod_database"]))
            {
                $cont = new AdminContr();
                $cont->listenInput($request);
            }
            
            if(isset($request["aggiungi_prod_database"]))
            {
                $cont = new AdminContr();
                $cont->listenInput($request);
            }
            
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
                $controller = new BaseContr();
                $controller->listenInput($request);
            }
        }
    }
?>