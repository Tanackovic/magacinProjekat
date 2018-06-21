<?php

class Cena_model extends Model {

    function __construct() {
        parent::__construct();
    }

    function vratiSveCene() {
        $statement = $this->db->prepare("SELECT * from cena");
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $cene = $statement->fetchAll();
            return $cene;
        } else {
            return 0;
        }
    }

    function promeniCenu($cena) {

        $datum_aktivacije = date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day'));
        $statement = $this->db->prepare("SELECT * from cena where datum_aktivacije = :datum_aktivacije");
        $statement->execute(array(
            ':datum_aktivacije' => $datum_aktivacije
        ));
        if ($statement->rowCount() == 0) {
            $statement = $this->db->prepare("UPDATE cena 
            SET datum_deaktivacije= :datum_deaktivacije
            WHERE datum_deaktivacije IS NULL ");
            $result_update = $statement->execute(array(
                ':datum_deaktivacije' => date('Y-m-d')
            ));
            if ($result_update > 0) {
                $statement = $this->db->prepare("INSERT into cena (cena, datum_aktivacije) values (:cena, :datum_aktivacije)");
                $result = $statement->execute(array(
                    ':cena' => $cena,
                    ':datum_aktivacije' => $datum_aktivacije
                ));
                if ($result > 0) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        }else{
            $statement = $this->db->prepare("UPDATE cena 
            SET cena= :cena
            WHERE datum_aktivacije = :datum_aktivacije");
            $result_update = $statement->execute(array(
                ':cena' => $cena,
                ':datum_aktivacije' => $datum_aktivacije
            ));
            if($result_update>0){
                return 1;
            }else{
                return 0;
            }
        }
    }

    function dodajCenu($cena) {

        $statement = $this->db->prepare("INSERT into cena (cena, datum_aktivacije) values (:cena, :datum_aktivacije)");
        $result = $statement->execute(array(
            ':cena' => $cena,
            ':datum_aktivacije' => date('Y-m-d')
        ));
        if ($result > 0) {
            return 1;
        } else {
            return 0;
        }
    }

}
