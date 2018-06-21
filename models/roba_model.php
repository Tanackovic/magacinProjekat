<?php

class Roba_model extends Model {

    public $id;
    public $broj;
    public $magacin_id;
    public $magacin_adresa;
    public $magacin_naziv;
    public $prostorija_id;
    public $prostorija_broj;
    public $polica_id;
    public $polica_broj;
    public $red_id;
    public $red_broj;
    public $roba_id;
    public $roba_naziv;
    public $roba_vrsta;
    public $roba_kolicina;
    public $roba_datum_evidentiranja;
    public $roba_barkod;
    public $prijemni_list_db;
    public $prijemni_list_datum;
    public $istorija_promena;
    public $delovodni_broj;
    public $otpremnica;
    public $stavke_otpremnice;
    public $cene;

    function __construct() {
        parent::__construct();
    }

    function dodajNovuRobu($naziv, $kolicina, $sekcija, $vrsta_robe) {
        $this->db->beginTransaction();
        Session::init();
        $logId = Session::get('loggedIn_id');
        $statement = $this->db->prepare("INSERT into roba ( osoba_id, datum_evidentiranja, vrsta_robe, naziv, sekcija_id, kolicina, roba_status) "
                . "values ( :osoblje_id, :datum_evidentiranja, :vrsta_robe, :naziv, :sekcija_id, :kolicina, :roba_status)");
        $result = $statement->execute(array(
            ':osoblje_id' => $logId,
            ':datum_evidentiranja' => date('Y-m-d'),
            ':vrsta_robe' => $vrsta_robe,
            ':naziv' => $naziv,
            ':sekcija_id' => $sekcija,
            ':kolicina' => $kolicina,
            ':roba_status' => 1
        ));

        if ($result == 1) {
            $inserted = $this->db->lastInsertId();
            $bar_code_data = "barcode-roba-" . $inserted;
            $statement = $this->db->prepare("update roba set barkod = :barkod where id = :roba_id");
            $result1 = $statement->execute(array(
                ':barkod' => $bar_code_data,
                ':roba_id' => $inserted
            ));
            if ($result1 == 1) {
                $this->zapamtiUIstoriji($inserted, null, $sekcija);
                $prijemni_list = $this->kreirajPrijemniList($inserted);
                $this->db->commit();
                return $prijemni_list;
            } else {
                $this->db->rollBack();
                return 0;
            }
        } else {
            $this->db->rollBack();
            return 0;
        }
    }

    function kreirajPrijemniList($roba_id) {
        $delovodniBroj = "pl-roba-" . $roba_id;
        $statement = $this->db->prepare("INSERT into prijemni_list (delovodni_broj, datum, roba_id) "
                . "values ( :delovodni_broj, :datum, :roba_id)");
        $result = $statement->execute(array(
            ':delovodni_broj' => $delovodniBroj,
            ':datum' => date('Y-m-d'),
            ':roba_id' => $roba_id
        ));
        if ($result > 0) {
            return $roba_id;
        } else {
            return 0;
        }
    }

    function prijemniList($id) {
        $statement = $this->db->prepare("SELECT pl.*, s.id as sekcija_id, s.sekcija_broj, m.id as magacin_id, "
                . "m.magacin_naziv, m.adresa, p.id as prostorija_id, p.prostorija_broj, po.id as polica_id, "
                . "po.polica_broj, r.id as red_id, r.red_broj, ro.id as roba_id, ro.naziv, ro.vrsta_robe, "
                . "ro.datum_evidentiranja, ro.kolicina, ro.barkod "
                . " FROM prijemni_list pl join roba ro on pl.roba_id = ro.id "
                . "join sekcija s on s.id = ro.sekcija_id "
                . "join red r on r.id = s.red_id "
                . "join polica po on po.id = r.polica_id "
                . "join prostorija p on po.prostorija_id = p.id "
                . "JOIN magacin m ON p.magacin_id = m.id "
                . "WHERE pl.roba_id = :id ");
        $statement->execute(array(
            ':id' => $id
        ));

        $red = $statement->fetch();
        $this->id = $red['sekcija_id'];
        $this->broj = $red['sekcija_broj'];
        $this->magacin_id = $red['magacin_id'];
        $this->magacin_naziv = $red['magacin_naziv'];
        $this->magacin_adresa = $red['adresa'];
        $this->prostorija_id = $red['prostorija_id'];
        $this->prostorija_broj = $red['prostorija_broj'];
        $this->polica_broj = $red['polica_broj'];
        $this->polica_id = $red['polica_id'];
        $this->red_id = $red['red_id'];
        $this->red_broj = $red['red_broj'];
        $this->sekcija_id = $red['sekcija_id'];
        $this->sekcija_broj = $red['sekcija_broj'];
        $this->roba_id = $red['roba_id'];
        $this->roba_naziv = $red['naziv'];
        $this->roba_vrsta = $red['vrsta_robe'];
        $this->roba_datum_evidentiranja = $red['datum_evidentiranja'];
        $this->roba_kolicina = $red['kolicina'];
        $this->prijemni_list_db = $red['delovodni_broj'];
        $this->prijemni_list_datum = $red['datum'];
        $this->roba_barkod = $red['barkod'];

        return $this;
    }

    function zapamtiUIstoriji($inserted, $sekcija_start, $sekcija_kraj) {
        Session::init();
        $logId = Session::get('loggedIn_id');
        $statement = $this->db->prepare("SELECT * from istorija_premestanja where roba_id= :roba_id  AND datum_izlaska IS NULL");
        $result = $statement->execute(array(
            ':roba_id' => $inserted
        ));
        if ($result > 0) {
            $red = $statement->fetch();
            $count = $statement->rowCount();
            if ($count > 0) {
                $istorija_id = $red['id'];
                $to = date_create(date('Y-m-d'));
                $from = date_create($red['datum_unosa']);
                $diff = date_diff($from, $to);
                $statement = $this->db->prepare("UPDATE istorija_premestanja "
                        . "set datum_izlaska = :datum, vreme_lezanja_u_danima = :vreme_lezanja "
                        . "where id= :istorija_id");
                $result = $statement->execute(array(
                    ':datum' => $to->format('Y-m-d'),
                    ':vreme_lezanja' => $diff->format('%a') + 1,
                    ':istorija_id' => $istorija_id
                ));
               // return $inserted;
            } 
            $statement = $this->db->prepare("INSERT into istorija_premestanja (roba_id, datum_unosa, osoba_id, sekcija_start_id, sekcija_kraj_id) "
                    . "values ( :roba_id, :datum, :osoblje_id, :sekcija_start_id, :sekcija_kraj_id)");
            $result = $statement->execute(array(
                ':roba_id' => $inserted,
                ':datum' => date('Y-m-d'),
                ':osoblje_id' => $logId,
                ':sekcija_start_id' => $sekcija_start,
                ':sekcija_kraj_id' => $sekcija_kraj,
            ));

            $statement = $this->db->prepare("UPDATE roba set sekcija_id = :sekcija_id where id=:roba_id");
            $result = $statement->execute(array(
                ':sekcija_id' => $sekcija_kraj,
                ':roba_id' => $inserted
            ));
            return $inserted;
            
        } else {
            return 0;
        }
    }

    function robaDetalji($id) {
        $this->detalji = $this->prijemniList($id);
        $statement = $this->db->prepare("SELECT ip.*, s1.`sekcija_adresni_kod` AS adr_kod_start, s2.`sekcija_adresni_kod` AS adr_kod_kraj, o.`ime`,o.`prezime`
                        FROM istorija_premestanja ip JOIN roba r ON r.id=ip.roba_id
                        JOIN osoba o ON ip.osoba_id = o.id
                        JOIN sekcija s1 ON ip.`sekcija_start_id` = s1.`id`
                        JOIN sekcija s2 ON ip.`sekcija_kraj_id` = s2.`id`
                        WHERE ip.roba_id= :roba_id
                        order by ip.datum_unosa desc");
        $result = $statement->execute(array(
            ':roba_id' => $id
        ));
        $this->istorija_promena = $statement->fetchAll();
        return $this;
    }

    function otpremniList($id) {
        $statement = $this->db->prepare("SELECT delovodni_broj, datum  from prijemni_list where roba_id = :roba_id ");
        $result = $statement->execute(array(
            ':roba_id' => $id
        ));

        $delovodniBroj = "otprema-roba-" . $id;
        $pl_delovodni_broj = $statement->fetch();
        $to = date_create(date('Y-m-d'));
        $from = date_create($pl_delovodni_broj['datum']);
        $diff = date_diff($from, $to);


        $statement = $this->db->prepare("INSERT INTO otpremni_list (delovodni_broj_otpremnice, delovodni_broj_prijemnog_lista, datum, roba_id, vreme_lezanja_u_danima)"
                . " values (:delovodni_broj_otpremnice, :delovodni_broj_prijemnog_list, :datum, :roba_id, :vreme_lezanja)");
        $result = $statement->execute(array(
            ':delovodni_broj_otpremnice' => $delovodniBroj,
            ':delovodni_broj_prijemnog_list' => $pl_delovodni_broj['delovodni_broj'],
            ':datum' => date('Y-m-d'),
            ':roba_id' => $id,
            ':vreme_lezanja' => $diff->format('%a')+1,
        ));
        $inserted = $this->db->lastInsertId();
        $statement = $this->db->prepare("SELECT ip.*, s1.`sekcija_adresni_kod` AS adr_kod_start, s2.`sekcija_adresni_kod` AS adr_kod_kraj, o.`ime`,o.`prezime`
                        FROM istorija_premestanja ip JOIN roba r ON r.id=ip.roba_id
                        JOIN osoba o ON ip.osoba_id = o.id
                        JOIN sekcija s1 ON ip.`sekcija_start_id` = s1.`id`
                        JOIN sekcija s2 ON ip.`sekcija_kraj_id` = s2.`id`
                        WHERE ip.roba_id= :roba_id
                        order by ip.datum_unosa desc");
        $result = $statement->execute(array(
            ':roba_id' => $id
        ));

        $stavke_otpremnice = $statement->fetchAll();
        foreach ($stavke_otpremnice as $stavka) {
            $statement = $this->db->prepare("INSERT INTO stavka_otpremnice (otpremnica_id, istorija_id, adr_kod_start, adr_kod_kraj, ime, prezime) "
                    . "values (:otpremnica_id, :istorija_id, :adr_kod_start, :adr_kod_kraj, :ime, :prezime)");
            $result = $statement->execute(array(
                ':otpremnica_id' => $inserted,
                ':istorija_id' => $stavka['id'],
                ':adr_kod_start' => $stavka['adr_kod_start'],
                ':adr_kod_kraj' => $stavka['adr_kod_kraj'],
                ':ime' => $stavka['ime'],
                ':prezime' => $stavka['prezime']
            ));
        }

        $statement = $this->db->prepare("UPDATE roba set roba_status = 0 where id = :roba_id");
        $result = $statement->execute(array(
            ':roba_id' => $id
        ));
        $this->napraviPredracun($inserted, $pl_delovodni_broj['datum'], date('Y-m-d'));
        header('location: ../../otpremnica/otpremnicaDetalji/' . $inserted);
    }

    function napraviPredracun($id_otpremnice, $datum_ulaza, $datum_izlaza) {

        $statement = $this->db->prepare("INSERT into predracun (datum, otpremnica_id, totalna_suma, broj_dana) values "
                . "(:datum, :otpremnica_id, :totalna_suma, :broj_dana)");
        $statement->execute(array(
            ':datum' => date('Y-m-d'),
            ':otpremnica_id' => $id_otpremnice,
            ':totalna_suma' => 0,
            ':broj_dana' => 0
        ));

        $inserted = $this->db->lastInsertId();

        $statement = $this->db->prepare("
            SELECT 1 AS broj, c.* 
            FROM cena c
            WHERE c.datum_aktivacije<:datum_ulaza AND (c.datum_deaktivacije>:datum_deaktivacije OR c.datum_deaktivacije IS NULL)
            UNION ALL
	    SELECT 2 AS broj, c.* 
            FROM cena c
            WHERE  c.datum_aktivacije<=:datum_ulaza  AND c.datum_deaktivacije<=:datum_deaktivacije AND c.datum_deaktivacije>=:datum_ulaza
            UNION ALL
            SELECT 3 AS broj, c.* 
            FROM cena c
            WHERE c.datum_aktivacije>:datum_ulaza AND c.datum_deaktivacije<:datum_deaktivacije
            UNION ALL
            SELECT 4 AS broj, c.* 
            FROM cena c
            WHERE :datum_deaktivacije >= c.datum_aktivacije AND :datum_ulaza < c.datum_aktivacije AND c.datum_deaktivacije IS NULL
        ");
        $statement->execute(array(
            ':datum_ulaza' => $datum_ulaza,
            ':datum_deaktivacije' => $datum_izlaza
        ));

        $grupe_cena = $statement->fetchAll();
        $dani = 0;
        $cena1 = 0;
        foreach ($grupe_cena as $cena) {
            if ($cena['broj'] == 1) {
                $from = date_create($datum_ulaza);
                $to = date_create($datum_izlaza);
                $datum_od = $cena['datum_aktivacije'];
                $datum_do = $datum_izlaza;
                $diff = date_diff($from, $to);
                $noviDani = floatval($diff->format('%a')) + 1;
                $total_za_dane = $noviDani * floatval($cena['cena']);
                $dani += $noviDani;
                $cena1 += $total_za_dane;
            } else if ($cena['broj'] == 2) {
                $from = date_create($datum_ulaza);
                $to = date_create($cena['datum_deaktivacije']);
                $datum_od = $datum_ulaza;
                $datum_do = $cena['datum_deaktivacije'];
                $diff = date_diff($from, $to);
                $noviDani = floatval($diff->format('%a')) + 1;
                $total_za_dane = $noviDani * floatval($cena['cena']);
                $dani += $noviDani;
                $cena1 += $total_za_dane;
            } else if ($cena['broj'] == 3) {
                $from = date_create($cena['datum_aktivacije']);
                $to = date_create($cena['datum_deaktivacije']);
                $datum_od = $cena['datum_aktivacije'];
                $datum_do = $cena['datum_deaktivacije'];
                $diff = date_diff($from, $to);
                $noviDani = floatval($diff->format('%a')) + 1;
                $total_za_dane = $noviDani * floatval($cena['cena']);
                $dani += $noviDani;
                $cena1 += $total_za_dane;
            } else if ($cena['broj' == 4]) {
                $from = date_create($cena['datum_aktivacije']);
                $to = date_create($datum_izlaza);
                $datum_od = $cena['datum_aktivacije'];
                $datum_do = $datum_izlaza;
                $diff = date_diff($from, $to);
                $noviDani = floatval($diff->format('%a')) + 1;
                $total_za_dane = $noviDani * floatval($cena['cena']);
                $dani += $noviDani;
                $cena1 += $total_za_dane;
            }

            $statement = $this->db->prepare("INSERT into stavka_predracuna 
                (datum_od, datum_do, predracun_id, cena_po_danu, total_cena_za_dane, broj_dana)
                values 
                (:datum_od, :datum_do, :predracun_id, :cena_po_danu,:total_cena_za_dane, :broj_dana)");
            $statement->execute(array(
                ':datum_od' => $datum_od,
                ':datum_do' => $datum_do,
                ':predracun_id' => $inserted,
                ':cena_po_danu' => $cena['cena'],
                ':broj_dana' => $noviDani,
                ':total_cena_za_dane' => $total_za_dane
            ));
        }
        $jedinstveni_broj = 'predracun_' . date('Y-m-d') . '_' . $inserted;
        $statement = $this->db->prepare("Update predracun 
                set  totalna_suma=:totalna_suma, broj_dana=:broj_dana, jedinstveni_broj= :jedinstveni_broj
                where id = :id");
        $statement->execute(array(
            ':totalna_suma' => $cena1,
            ':broj_dana' => $dani,
            ':id' => $inserted,
            ':jedinstveni_broj' => $jedinstveni_broj
        ));
    }

}
