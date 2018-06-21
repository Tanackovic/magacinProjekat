<?php

class Prostorija_model extends Model {

    public $id;
    public $broj;
    public $police;
    public $magacin;

    function __construct() {
        parent::__construct();
        require 'magacin_model.php';
        $this->magacin = new Magacin_model();
    }

    function dodajNovuProstoriju($magacin_id, $broj) {
        $statement = $this->db->prepare("INSERT into prostorija (magacin_id , prostorija_broj, prostorija_status) values (:magacin_id, :broj, :status)");
        $result = $statement->execute(array(
            ':magacin_id' => $magacin_id,
            ':broj' => $broj,
            ':status' => 1
        ));
        return $result;
    }

    function prostorijaDetalji($id) {
        $statement_prostorija = $this->db->prepare("SELECT * FROM prostorija p JOIN magacin m ON p.magacin_id = m.id "
                . "WHERE p.id = :id ");
        $statement_prostorija->execute(array(
            ':id' => $id
        ));
        if ($statement_prostorija->rowCount() > 0) {
            $prostorija = $statement_prostorija->fetch();
            $this->id = $prostorija['id'];
            $this->broj = $prostorija['prostorija_broj'];
            $this->magacin->id = $prostorija['magacin_id'];
            $this->magacin->naziv = $prostorija['magacin_naziv'];
            $this->magacin->adresa = $prostorija['adresa'];

            $statement = $this->db->prepare("SELECT * from polica where prostorija_id = :id ");
            $statement->execute(array(
                ':id' => $id
            ));
            $police = $statement->fetchAll();
            $this->police = $police;
        }
        return $this;
    }

    function popuniKombo($mag_id) {
        $statement = $this->db->prepare("SELECT * from prostorija where magacin_id = :id");
        $statement->execute(array(
            ':id' => $mag_id
        ));

        $prostorije = $statement->fetchAll();
        print_r(json_encode($prostorije));
    }

    function izmeniProstoriju($prostorija_id, $broj) {
        $statement = $this->db->prepare("update prostorija set prostorija_broj = :broj where id = :prostorija_id");
        $result = $statement->execute(array(
            ':prostorija_id' => $prostorija_id,
            ':broj' => $broj
        ));
        if ($result > 0) {
            $result_update = $this->izmeniAdresniKod($prostorija_id);
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
                WHERE p.id = :id ");
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
