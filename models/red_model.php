<?php

class Red_model extends Model {

    public $id;
    public $broj;
    public $polica;
    public $sekcije;

    function __construct() {
        parent::__construct();
        require 'polica_model.php';
        $this->polica = new Polica_model();
    }

    function dodajNoviRed($polica_id, $broj) {
        $statement = $this->db->prepare("INSERT into red (polica_id , red_broj) values (:polica_id, :broj)");
        $result = $statement->execute(array(
            ':polica_id' => $polica_id,
            ':broj' => $broj
        ));
        return $result;
    }

    function redDetalji($id) {
        $statement = $this->db->prepare("SELECT r.*, po.id as polica_id, po.polica_broj, "
                . "p.id as prostorija_id, p.prostorija_broj, m.id as magacin_id, m.magacin_naziv, m.adresa " 
                . "FROM red r join polica po on po.id = r.polica_id "
                . "join prostorija p on po.prostorija_id = p.id "
                . "JOIN magacin m ON p.magacin_id = m.id "
                . "WHERE r.id = :id ");
        $statement->execute(array(
            ':id' => $id
        ));
        if ($statement->rowCount() > 0) {
            $red = $statement->fetch();
            $this->id = $red['id'];
            $this->broj = $red['red_broj'];
            $this->polica->id = $red['polica_id'];
            $this->polica->broj = $red['polica_broj'];
            $this->polica->prostorija->id = $red['prostorija_id'];
            $this->polica->prostorija->broj = $red['prostorija_broj'];
            $this->polica->prostorija->magacin->id = $red['magacin_id'];
            $this->polica->prostorija->magacin->naziv = $red['magacin_naziv'];
            $this->polica->prostorija->magacin->adresa = $red['adresa'];



            $statement = $this->db->prepare("SELECT * from sekcija where red_id = :id ");
            $statement->execute(array(
                ':id' => $id
            ));

            $sekcije = $statement->fetchAll();
            $this->sekcije = $sekcije;
        }
        return $this;
    }

    function popuniKombo($polica_id) {
        $statement = $this->db->prepare("SELECT * from red where polica_id = :id");
        $statement->execute(array(
            ':id' => $polica_id
        ));

        $red = $statement->fetchAll();
        print_r(json_encode($red));
    }
    
    function izmeniRed($red_id, $broj) {
        $statement = $this->db->prepare("update red set red_broj = :broj where id = :red_id");
        $result = $statement->execute(array(
            ':red_id' => $red_id,
            ':broj' => $broj
        ));
        if ($result > 0) {
            $result_update = $this->izmeniAdresniKod($red_id);
            return $result_update;
        } else {
            return 0;
        }
    }
    
    function izmeniAdresniKod($id) {
        $statement = $this->db->prepare("SELECT s.*, r.red_broj, po.polica_broj, p.prostorija_broj, m.magacin_naziv
                FROM sekcija s JOIN red r ON s.`red_id`=r.id
                JOIN polica po ON po.id = r.polica_id 
                JOIN prostorija p ON po.prostorija_id = p.id 
                JOIN magacin m ON p.magacin_id = m.id 
                WHERE r.id = :id ");
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
