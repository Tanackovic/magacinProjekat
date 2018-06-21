<?php

class Magacin_model extends Model {

    public $id;
    public $naziv;
    public $adresa;
    public $prostorije;

    function __construct() {
        parent::__construct();
    }

    function vratiSveMagacine() {
        $statement = $this->db->prepare("SELECT * from magacin");
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $magacini = $statement->fetchAll();
            return $magacini;
        } else {
            return 0;
        }
    }

    function dodajNoviMagacin($naziv, $adresa) {
        $statement = $this->db->prepare("INSERT into magacin (magacin_naziv, adresa, magacin_status) values (:magacin_naziv, :adresa, :magacin_status)");
        $result = $statement->execute(array(
            ':magacin_naziv' => $naziv,
            ':adresa' => $adresa,
            ':magacin_status' => 1
        ));
        return $result;
    }

    function magacinDetalji($id) {
        $statement_magacin = $this->db->prepare("SELECT * from magacin where id = :id ");
        $statement_magacin->execute(array(
            ':id' => $id
        ));

        if ($statement_magacin->rowCount() > 0) {
            $magacin = $statement_magacin->fetch();
            $this->id = $magacin['id'];
            $this->naziv = $magacin['magacin_naziv'];
            $this->adresa = $magacin['adresa'];
            $statement = $this->db->prepare("SELECT * from prostorija where magacin_id = :id ");
            $statement->execute(array(
                ':id' => $id
            ));

            $prostorije = $statement->fetchAll();
            $this->prostorije = $prostorije;
        }
        return $this;
    }

    function popuniKombo() {
        print_r(json_encode($this->vratiSveMagacine()));
    }

    function izmeniMagacin($magacin_id, $naziv, $adresa) {
        $statement = $this->db->prepare("update magacin "
                . "set adresa = :adresa, magacin_naziv = :naziv "
                . "where id = :id");
        $result = $statement->execute(array(
            ':naziv' => $naziv,
            ':adresa' => $adresa,
            ':id' => $magacin_id
        ));
        if ($result > 0) {
            $result_update = $this->izmeniAdresniKod($magacin_id);
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
                WHERE m.id = :id ");
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
