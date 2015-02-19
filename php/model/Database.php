<?php
    class Database
    {
        private function __construct()
        {

        }
        //Collego il database
        public static function connettiDatabase()
        {
            $mysqli = new mysqli();
            $mysqli->connect("localhost", "crobuWalter", "gabbiano20", "amm14_crobuWalter");
            return $mysqli;
        }
    }
?>
