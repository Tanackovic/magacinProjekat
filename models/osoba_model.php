<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Osoba_model extends Model{
    public $ime;
    public $prezime;
    public $korisnicko_ime;
    public $uloga;

   function __construct() {
        parent::__construct();
    }
    
    function vratiSveOsobe(){
        $statement = $this->db->prepare("SELECT osoba_id, ime, prezime, korisnicko_ime, uloga from osoba where is_aktivna='1'");
        $statement->execute();
        if($statement->rowCount() > 0){
            $osoba = $statement->fetchAll();
            return $osoba; 
        }else{
            return 0;
        }
    }
    
    function dodajNovuOsobu($ime, $prezime, $korisnicko_ime, $password, $uloga){
        $statement_postoji = $this->db->prepare("select korisnicko_ime from osoba where korisnicko_ime=:korisnicko_ime");
        $statement_postoji->execute(array(
            ':korisnicko_ime' => $korisnicko_ime
        ));
        if ($statement_postoji->rowCount() > 0){
            return 0;
        }else{
            $statement_unesi = $this->db->prepare("INSERT into osoba (ime, prezime, korisnicko_ime, password, uloga, is_aktivna) "
                    . " values (:ime, :prezime, :korisnicko_ime, :password, :uloga, :status_osobe)");
            $result = $statement_unesi->execute(array(
                ':ime' => $ime,
                ':prezime' => $prezime,
                ':korisnicko_ime' => $korisnicko_ime,
                ':password' => md5($password),
                ':uloga' => $uloga,
                ':status_osobe' => 1,
            ));
            return $result;
        }
    }
    
    function vratiOsobu($id){
        $statement = $this->db->prepare("SELECT osoba_id, ime, prezime, korisnicko_ime, uloga from osoba where osoba_id= :id");
        $statement->execute(array(
            ':id' => $id
        ));
        if($statement->rowCount() > 0){
            $osoba = $statement->fetch();
            return $osoba; 
        }else{
            return 0;
        }  
    }
    
    function arhivirajOsobu($id){
        $statement = $this->db->prepare("update osoba set is_aktivna = 0 where osoba_id = :id");
        $result = $statement->execute(array(
            ':id' => $id
        ));
        return $result;
    }
}
