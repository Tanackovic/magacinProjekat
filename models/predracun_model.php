<?php

class Predracun_model extends Model {

    public $predracuni;
    public $predracun;
    
    function __construct() {
        parent::__construct();
    }

    function index() {
        $statement = $this->db->prepare("SELECT p.*, o.delovodni_broj_otpremnice from predracun p 
                 join otpremni_list o on p.otpremnica_id = o.id");
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $this->predracuni = $statement->fetchAll();
            return $this;
        } else {
            return 0;
        }
    }

    function predracunDetalji($id) {
        $statement = $this->db->prepare("SELECT p.*, o.delovodni_broj_otpremnice from predracun p 
                 join otpremni_list o on p.otpremnica_id = o.id 
                 where p.id = :id");
        $result = $statement->execute(array(
            ':id' => $id
        ));

        if ($statement->rowCount() > 0) {
            $this->predracun = $statement->fetch();

            $statement = $this->db->prepare("SELECT * from stavka_predracuna where predracun_id =:id");
            $result = $statement->execute(array(
                ':id' => $id
            ));

            $this->stavke_predracuna = $statement->fetchAll();
        }
        return $this;
    }

}
