<?php

class Dashboard_model extends Model
{
    function __construct() {
        parent::__construct();
    }
       
    function robaSearch($naziv){
        $statement = $this->db->prepare("SELECT r.*, CONCAT(o.ime, ' ',o.`prezime`) as ime_prezime, s.`sekcija_adresni_kod` as adresa FROM roba r 
            JOIN osoba o ON r.osoba_id = o.osoba_id 
            JOIN sekcija s ON s.`sekcija_id` = r.`sekcija_id` 
            JOIN prijemni_list p ON p.`roba_id` = r.`roba_id`
            WHERE r.is_aktivna='1' and r.naziv like '$naziv%'");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}

