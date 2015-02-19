<?php
//Assegno le funzioni alla struttura dell'utente
class User
{
    const User = 1;
    const Admin = 2;

    private $username;
    private $password;
    private $nome;
    private $cognome;
    private $mail;
    private $ruolo;
    private $indirizzo;
    private $id;

    public function __construct()        
    {
        
    }

    public function esiste() 
    {
        return isset($this->ruolo);
    }

    public function getUserName() 
    {
        return $this->username;
    }
    public function setUserName($username) 
    {
        if (!filter_var($username, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/[a-zA-Z]{5,}/')))) 
        {
            return false;
        }
        $this->username = $username;
        return true;
    }

    public function getPassword() 
    {
        return $this->password;
    }
    public function setPassword($password) 
    {
        $this->password = $password;
        return true;
    }

    public function getNome() 
    {
        return $this->nome;
    }
    public function setNome($nome) 
    {
        $this->nome = $nome;
        return true;
    }

    public function getCognome() 
    {
        return $this->cognome;
    }
    public function setCognome($cognome) 
    {
        $this->cognome = $cognome;
        return true;
    }

    public function setRuolo($ruolo) 
    {
        switch ($ruolo) 
        {
            case self::User:
            case self::Admin:
                $this->ruolo = $ruolo;
                return true;
            default:
                return false;
        }
    }
    public function getRuolo() 
    {
        return $this->ruolo;
    }
   

    public function getMail() 
    {
        return $this->mail;
    }
    public function setMail($mail) {
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
        {
            return false;
        }
        $this->email = $mail;
        return true;
    }

    public function getIndirizzo() 
    {
        return $this->indirizzo;
    }
    public function setIndirizzo($indirizzo) 
    {
        $this->indirizzo = $indirizzo;
        return true;
    }

    
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $intVal = filter_var($id, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
        if(!isset($intVal))
        {
            return false;
        }
        $this->id = $intVal;
    }
    
    public function equals(User $user) 
    {
        return  $this->id == $user->id &&
                $this->nome == $user->nome &&
                $this->cognome == $user->cognome &&
                $this->ruolo == $user->ruolo;
    }
}

?>