<?php
//Assegno le funzioni alla struttura del prodotto
class Prodotto
{
    private $id_prodotto;
    private $id_carrello;
    private $tipo;
    private $marca;
    private $nome;
    private $descrizione;
    private $quantita;
    private $prezzo;
    
    public function __construct()
    {
        
    }
    
    public function setIdProdotto($id_prodotto)
    {
        $this->id_prodotto = $id_prodotto;
    }
    public function getIdProdotto()
    {
        return $this->id_prodotto;
    }
    
    public function setIdCarrello($id_carrello)
    {
        $this->id_carrello = $id_carrello;
    } 
    public function getIdCarrello()
    {
        return $this->id_carrello;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    
    public function getTipo()
    {
        return $this->tipo;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }
    
    public function getMarca()
    {
        return $this->marca;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }
    
    public function getDescrizione()
    {
        return $this->descrizione;
    }
    
    public function setQuantita($quantita)
    {
        $this->quantita = $quantita;
    }
    
    public function getQuantita()
    {
        return $this->quantita;
    }
    
    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }
    
    public function getPrezzo()
    {
        return $this->prezzo;
    }
}
?>