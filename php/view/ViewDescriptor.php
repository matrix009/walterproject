<?php
    class ViewDescriptor
    {
        const get = 'get';
        const post = 'post';
        
        private $titolo;
        private $colonna_d_file;
        private $colonna_s_file;
        private $footer_file;
        private $content_file;
        private $menu_logo_file;
        private $messaggioConferma;
        private $messaggioErrore;
        private $pagina;
        private $sottoPagina;
        private $impToken;
        private $js;
        private $json;
    
        public function __construct()
        {
            $this->js = array();
            $this->json = false;
        }
        
        public function getTitolo()
        {
            return $this->titolo;
        }       
        public function setTitolo($titolo)
        {
            $this->titolo = $titolo;
        }
        
        public function getColonnaDFile()
        {
            return $this->colonna_d_file;
        }
        public function setColonnaDFile($colonnaDFile)
        {
            $this->colonna_d_file = $colonnaDFile;
        }
        
        public function getColonnaSFile()
        {
            return $this->colonna_s_file;
        }
        public function setColonnaSFile($colonnaSFile)
        {
            $this->colonna_s_file = $colonnaSFile;
        }
        
        public function getFooterFile()
        {
            return $this->footer_file;
        }
        public function setFooterFile($footerFile)
        {
            $this->footer_file = $footerFile;
        }        
        
        public function getContentFile()
        {
            return $this->content_file;
        }
        public function setContentFile($contentFile)
        {
            $this->content_file = $contentFile;
        }
        
        public function getMenuLogoFile()
        {
            return $this->menu_logo_file;
        }
        public function setMenuLogoFile($menuLogoFile)
        {
            $this->menu_logo_file = $menuLogoFile;
        }
        
        public function getMessaggioConferma()
        {
            return $this->messaggioConferma;
        }
        public function setMessaggioConferma($msg)
        {
            $this->messaggioConferma = $msg;
        }
        public function getMessaggioErrore()
        {
            return $this->messaggioErrore;
        }
        public function setMessaggioErrore($msg)
        {
            $this->messaggioErrore = $msg;
        }
        
        public function setPagina($pagina) 
        {
            $this->pagina = $pagina;
        }
        public function getPagina() 
        {
            return $this->pagina;
        }
        
        public function getSottoPagina() 
        {
            return $this->sottoPagina;
        }
        public function setSottoPagina($pag) 
        {
            $this->sottoPagina = $pag;
        }
        
        public function addScript($nome)
        {
            $this->js[] = $nome;
        }
        public function &getScripts()
        {
            return $this->js;
        }
        
        public function isJson()
        {
            return $this->json;
        }
        public function toggleJson()
        {
            $this->json = true;
        }
        
        public function setImpToken($token)
        {
            $this->impToken = $token;
        }
        public function scriviToken($pre = '', $method = self::get) 
        {
            $imp = BaseContr::impersonato;
            switch ($method) {
                case self::get:
                    if (isset($this->impToken)) 
                    {
                        return $pre . "$imp=$this->impToken";
                    }
                    break;

                case self::post:
                    if (isset($this->impToken)) 
                    {
                        return "<input type=\"hidden\" name=\"$imp\" value=\"$this->impToken\"/>";
                    }
                    break;
            }

            return '';
        }
    }
?>
