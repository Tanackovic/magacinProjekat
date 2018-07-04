<?php

class Sekcija_model extends Model {

    public $id;
    public $broj;
    public $red;
    public $roba;

    function __construct() {
        parent::__construct();
        require 'red_model.php';
        $this->red = new Red_model();
    }

    function dodajNovuSekciju($red_id, $broj) {
        $adresni_kod = $this->napraviAdresniKod($red_id, $broj);
        $statement = $this->db->prepare("INSERT into sekcija (red_id , sekcija_broj, sekcija_adresni_kod) values (:red_id, :broj, :adresni_kod)");
        $result = $statement->execute(array(
            ':red_id' => $red_id,
            ':broj' => $broj,
            ':adresni_kod' => $adresni_kod
        ));
        return $result;
    }

    function sekcijaDetalji($id) {
        $statement_sekcija = $this->db->prepare("SELECT * "
                . "FROM sekcija s join red r on r.red_id = s.red_id "
                . "join polica po on po.polica_id = r.polica_id "
                . "join prostorija p on po.prostorija_id = p.prostorija_id "
                . "JOIN magacin m ON p.magacin_id = m.magacin_id "
                . "WHERE s.sekcija_id = :id ");
        $statement_sekcija->execute(array(
            ':id' => $id
        ));
        if ($statement_sekcija->rowCount() > 0) {
            $red = $statement_sekcija->fetch();
            $this->id = $red['sekcija_id'];
            $this->broj = $red['sekcija_broj'];
            $this->red->id = $red['red_id'];
            $this->red->broj = $red['red_broj'];
            $this->red->polica->broj = $red['polica_broj'];
            $this->red->polica->id = $red['polica_id'];
            $this->red->polica->prostorija->id = $red['prostorija_id'];
            $this->red->polica->prostorija->broj = $red['prostorija_broj'];
            $this->red->polica->prostorija->magacin->id = $red['magacin_id'];
            $this->red->polica->prostorija->magacin->naziv = $red['magacin_naziv'];
            $this->red->polica->prostorija->magacin->adresa = $red['adresa'];
            $statement = $this->db->prepare("SELECT * from roba where sekcija_id = :id and is_aktivna='1'");
            $statement->execute(array(
                ':id' => $id
            ));

            $roba = $statement->fetchAll();
            $this->roba = $roba;
        }
        return $this;
    }

    function popuniKombo($red_id) {
        $statement = $this->db->prepare("SELECT * from sekcija where red_id = :id");
        $statement->execute(array(
            ':id' => $red_id
        ));

        $sekcije = $statement->fetchAll();
        print_r(json_encode($sekcije));
    }

    function napraviAdresniKod($red_id, $broj) {
        $statement = $this->db->prepare("SELECT * FROM red r join polica po on po.polica_id = r.polica_id "
                . "join prostorija p on po.prostorija_id = p.prostorija_id "
                . "JOIN magacin m ON p.magacin_id = m.magacin_id "
                . "WHERE r.red_id = :id ");
        $statement->execute(array(
            ':id' => $red_id
        ));
        $red = $statement->fetch();
        return $red['magacin_naziv'] . ', ' . $red['prostorija_broj'] . ', ' . $red['polica_broj'] . ', ' . $red['red_broj'] . ', ' . $broj;
    }

    function izmeniSekciju($sekcija_id, $broj) {
        $statement = $this->db->prepare("update sekcija set sekcija_broj = :broj where sekcija_id = :sekcija_id");
        $result = $statement->execute(array(
            ':sekcija_id' => $sekcija_id,
            ':broj' => $broj
        ));
        if ($result > 0) {
            $result_update = $this->izmeniAdresniKod($sekcija_id);
            return $result_update;
        } else {
            return 0;
        }
    }
    
    function izmeniAdresniKod($id) {
        $statement = $this->db->prepare("SELECT s.*, r.red_broj, po.polica_broj, p.prostorija_broj, m.magacin_naziv
                FROM sekcija s JOIN red r ON s.`red_id`=r.red_id
                JOIN polica po ON po.polica_id = r.polica_id 
                JOIN prostorija p ON po.prostorija_id = p.prostorija_id 
                JOIN magacin m ON p.magacin_id = m.magacin_id 
                WHERE s.sekcija_id = :id ");
        $statement->execute(array(
            ':id' => $id
        ));
        $red = $statement->fetchAll();
        foreach ($red as $sekcija) {
            $statement_novikod = $this->db->prepare("update sekcija set sekcija_adresni_kod = :adresni_kod where sekcija_id = :id ");
            $statement_novikod->execute(array(
                ':adresni_kod' => $sekcija['magacin_naziv'] . ', ' . $sekcija['prostorija_broj'] . ', ' . $sekcija['polica_broj'] . ', ' . $sekcija['red_broj'] . ', ' . $sekcija['sekcija_broj'],
                ':id' => $sekcija['sekcija_id']
            ));
        }
        return 1;
    }
}
