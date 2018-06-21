<?php

class Polica_model extends Model {

    public $id;
    public $broj;
    public $redovi;
    public $prostorija;

    function __construct() {
        parent::__construct();
        require 'prostorija_model.php';
        $this->prostorija = new Prostorija_model();
    }

    function dodajNovuPolicu($prostorija_id, $broj) {
        $statement = $this->db->prepare("INSERT into polica (prostorija_id , polica_broj) values (:prostorija_id, :broj)");
        $result = $statement->execute(array(
            ':prostorija_id' => $prostorija_id,
            ':broj' => $broj
        ));
        return $result;
    }

    function policaDetalji($id) {
        $statement_polica = $this->db->prepare("SELECT * FROM polica po "
                . "join prostorija p on po.prostorija_id = p.id "
                . "JOIN magacin m ON p.magacin_id = m.id "
                . "WHERE po.id = :id ");
        $statement_polica->execute(array(
            ':id' => $id
        ));
        if ($statement_polica->rowCount() > 0) {
            $polica = $statement_polica->fetch();
            $this->id = $polica['id'];
            $this->broj = $polica['polica_broj'];
                $this->prostorija->id = $polica['prostorija_id'];
                $this->prostorija->broj = $polica['prostorija_broj'];
                $this->prostorija->magacin->id = $polica['magacin_id'];
                $this->prostorija->magacin->naziv= $polica['magacin_naziv'];
                $this->prostorija->magacin->adresa = $polica['adresa'];
            
            $statement = $this->db->prepare("SELECT * from red where polica_id = :id ");
            $statement->execute(array(
                ':id' => $id
            ));

            $redovi = $statement->fetchAll();
            $this->redovi = $redovi;
        }
        return $this;
    }

    function popuniKombo($prostorija_id) {
        $statement = $this->db->prepare("SELECT * from polica where prostorija_id = :id");
        $statement->execute(array(
            ':id' => $prostorija_id
        ));

        $police = $statement->fetchAll();
        print_r(json_encode($police));
    }
    
    function izmeniPolicu($polica_id, $broj) {
        $statement = $this->db->prepare("update polica set polica_broj = :broj where id = :polica_id");
        $result = $statement->execute(array(
            ':polica_id' => $polica_id,
            ':broj' => $broj
        ));
        if ($result > 0) {
            $result_update = $this->izmeniAdresniKod($polica_id);
            return $result_update;
        } else {
            return 0;
        }
    }
    
    function izmeniAdresniKod($id) {
        $statement = $this->db->prepare("SELECT s.*, r.red_broj, po.polica_broj, p.prostorija_broj, m.magacin_naziv FROM sekcija s JOIN red r ON s.`red_id`=r.id
                JOIN polica po ON po.id = r.polica_id 
                JOIN prostorija p ON po.prostorija_id = p.id 
                JOIN magacin m ON p.magacin_id = m.id 
                WHERE po.id = :id ");
        $statement->execute(array(
            ':id' => $id
        ));
        $red = $statement->fetchAll();
        foreach ($red as $sekcija) {
            $statement_novikod = $this->db->prepare("update sekcija set sekcija_adresni_kod = :adresni_kod where id = :id ");
            $statement_novikod->execute(array(
                ':adresni_kod' => $sekcija['magacin_naziv'] . ', ' . $sekcija['prostorija_broj'] . ', ' . $sekcija['polica_broj'] . ', ' . $sekcija['red_broj'] . ', ' . $sekcija['sekcija_broj'],
                ':id' => $sekcija['id']
            ));
        }
        return 1;
    }

}
