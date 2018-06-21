<?php

class login_model extends Model
{
    function __construct() {
        parent::__construct();
    }
    
    function login($username, $password){
        
        $statement = $this->db->prepare("SELECT id, ime, prezime, korisnicko_ime, uloga FROM osoba where "
                . "korisnicko_ime = :korisnicko_ime and password= :password and status_osobe=1");
        $statement->execute(array(
            ':korisnicko_ime' => $username,
            ':password' => md5($password)
        ));
        $count = $statement->rowCount();
        
        if($count > 0){
            $osoba = $statement->fetch();
            $imeIPrezime = $osoba['ime'] . " " . $osoba['prezime'];
            $id = $osoba['id'];
            $uloga = $osoba['uloga'];
            Session::init();
            Session::set('loggedIn', true);
            Session::set('osoba', $imeIPrezime);
            Session::set('loggedIn_id', $id);
            Session::set('uloga', $uloga);
            return 1;
        }
        else {
            return 0;
        }
    }
}
