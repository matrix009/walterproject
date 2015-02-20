<?php
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
    
    public function listenInput(&$request) 
    {
        $vd = new ViewDescriptor();
        $vd->setPagina($request['page']);
        $this->setImpToken($vd, $request);

        if (isset($request["cmd"])) 
        {
            switch ($request["cmd"]) 
            {
               case 'Login':
                    $username = isset($request['user']) ? $request['user'] : '';
                    $password = isset($request['password']) ? $request['password'] : '';
                    $this->login($vd, $username, $password);
                    if ($this->loggedIn())
                        $user = GuestDatabase::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
                    break;
                    
                default : $this->showLoginPage();
            }
        } 
        else 
        {
            if ($this->loggedIn()) 
            {

            } 
            else 
            {
                if(isset($request["sottopagina"]))
                {
                    switch($request["sottopagina"])
                    {
                        case informazioni:
                            $vd->setSottoPagina('informazioni');
                            break;
                    }
                }
                $this->showLoginPage($vd);
            }
        }
    }
    
    protected function loggedIn()
    {
        return isset($_SESSION) && array_key_exists(self::user, $_SESSION);
    }

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

    protected function showHomeUtente($vd) 
    {
        $user = GuestDatabase::instance()->cercaUtentePerId($_SESSION[self::user], $_SESSION[self::role]);
        switch ($user->getRuolo()) 
        {
            case User::User:
                $this->showHomeUser($vd);
                break;
            
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