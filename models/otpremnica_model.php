<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Otpremnica_model extends Model
{
    public $otpremnica;
    public $otpremnice;
    public $stavke_otpremnice;
    
    function __construct() {
        parent::__construct();
    }
     
    function index(){
        $statement = $this->db->prepare("SELECT * from otpremni_list");
        $statement->execute();
        if($statement->rowCount() > 0 ){
            $this->otpremnice = $statement->fetchAll();
            return $this;
        }else{
            return 0;
        }
    }
    
    function otpremnicaDetalji($id){
        $statement = $this->db->prepare("SELECT * from otpremni_list where id = :id");
        $result = $statement->execute(array(
            ':id' => $id
        ));
        if($statement->rowCount() > 0 ){
            $this->otpremnica = $statement->fetch();
            $statement = $this->db->prepare("SELECT * from stavka_otpremnice so join istorija_premestanja ip on ip.id = so.istorija_id "
                        . "where so.otpremnica_id = :id");
            $result = $statement->execute(array(
                ':id' => $id
            ));
            $this->stavke_otpremnice = $statement->fetchAll();
        }
        return $this;
    }
}