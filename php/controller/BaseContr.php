<?php
//Includo i file necessari
include_once basename(__DIR__) . '/../view/ViewDescriptor.php'; 
include_once basename(__DIR__) . '/../model/GuestDatabase.php';
include_once basename(__DIR__) . '/../model/ViewProdDatabase.php';

class BaseContr
{
    const user = 'user';
    const role = 'role';
    const impersonato = '_imp';
    
    var $user;
    
    public function __construct()
    {
        
    }
    //Il controller gestisce il login
    public function listenInput(&$request) 
    {
        $vd = new ViewDescriptor();
        $vd->setPagina(isset($request['page']));
        $this->setImpToken($vd, $request);
        //Gestione login in base all'utente
        if (isset($request["cmd"])) 
        {
            switch ($request["cmd"]) 
            {
               case 'Login':
                    $username = isset($request['user']) ? $request['user'] : '';
                    $password = isset($request['password']) ? $request['password'] : '';
                    $this->login($vd, $username, $password);

                    $user = GuestDatabase::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
                    break;
                //Se il login è sbagliato, mostro la pagina di login    
                default : $this->showLoginPage();
            }
        } 
        else 
        {       //Gestione sottopagina da parte di un utente non loggato
            if(isset($request["sottopagina"]))
            {
                switch($request["sottopagina"])
                {
                    case 'informazioni':
                    $vd->setSottoPagina('informazioni');
                    
                        break;
                }
            }
            $this->showLoginPage($vd);
         }
    }
    //Carico tramite la vista la pagina di login
    protected function showLoginPage($vd)
    {
        $vd->setTitolo("Tutto Informatica - Login");
        $vd->setColonnaDFile (basename(__DIR__) . '/../view/guest/colonna_d.php');
        $vd->setColonnaSFile (basename(__DIR__) . '/../view/guest/colonna_s.php');
        $vd->setFooterFile (basename(__DIR__) . '/../view/guest/footer.php');
        $vd->setContentFile (basename(__DIR__) . '/../view/guest/login.php');
        $vd->setMenuLogoFile (basename(__DIR__) . '/../view/guest/menu_logo.php');
        
        require basename(__DIR__) . '/../view/Page.php';
    }
    //Carico tramite la vista la pagina dell'utente
    protected function showHomeUser($vd) 
    {
        $vd->setTitolo("Tutto Informatica - Benvenuto Utente");
        $vd->setColonnaDFile (basename(__DIR__) . '/../view/user/colonna_d.php');
        $vd->setColonnaSFile (basename(__DIR__) . '/../view/user/colonna_s.php');
        $vd->setFooterFile (basename(__DIR__) . '/../view/user/footer.php');
        $vd->setContentFile (basename(__DIR__) . '/../view/user/content.php');
        $vd->setMenuLogoFile (basename(__DIR__) . '/../view/user/menu_logo.php');

        require basename(__DIR__) . '/../view/Page.php';
    }
    //Carico tramite la vista la pagina dell'admin
    protected function showHomeAdmin($vd) 
    {
        $vd->setTitolo("Tutto Informatica - Benvenuto Admin");
        $vd->setColonnaDFile (basename(__DIR__) . '/../view/admin/colonna_d.php');
        $vd->setColonnaSFile (basename(__DIR__) . '/../view/admin/colonna_s.php');
        $vd->setFooterFile (basename(__DIR__) . '/../view/admin/footer.php');
        $vd->setContentFile (basename(__DIR__) . '/../view/admin/content.php');
        $vd->setMenuLogoFile (basename(__DIR__) . '/../view/admin/menu_logo.php');
        
        require basename(__DIR__) . '/../view/Page.php';
    }
    //Visualizzo la pagina associata al tipo di utente loggato
    protected function showHomeUtente($vd) 
    {
        $user = GuestDatabase::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
        switch ($user->getRuolo()) 
        {   //Caso utente normale
            case User::User:
                $this->showHomeUser($vd);
                break;
            //Caso admin
            case User::Admin:
                $this->showHomeAdmin($vd);
                break;
        }
    }

    protected function setImpToken(ViewDescriptor $vd, $request) 
    {
        if (array_key_exists('_imp', $request)) 
        {
            $vd->setImpToken($request['_imp']);
        }
    }
    //Questa funzione controlla se nel database sono presenti i valori inseriti nel login
    protected function login($vd, $username, $password) 
    {
        $this->user = GuestDatabase::instance()->caricaUtente($username, $password);
        if (isset($this->user) && $this->user->esiste()) 
        {
            $_SESSION[self::user] = $this->user->getId();
            $_SESSION[self::role] = $this->user->getRuolo();
            $this->showHomeUtente($vd);
        } else 
        {
            $vd->setMessaggioErrore("Utente sconosciuto o password errata");
            $this->showLoginPage($vd);
        }
    }
    //Funzione di logout che distrugge la sessione e mostra la pagina di login
    protected function logout($vd)
    {
        $_SESSION = array();
        if (session_id() != '' || isset($_COOKIE[session_name()])) 
        {
            setcookie(session_name(), '', time() - 2592000, '/');
        }
        session_destroy();
        
        $this->showLoginPage($vd);
    }
}

?>
