<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Roba detalji</h2>
</header>

<div class="table-responsive">

    <table class="table">
    
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Naziv</th>
                <th scope="col">Vrsta robe</th>
                <th scope="col">Kolicina</th>
                <th scope="col">Datum evidentiranja</th>
                <th scope="col">Barkod</th>
                <th scope="col">Lokacija robe</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th scope="row">1</th>
                <td><?php echo $this->roba->detalji->roba_naziv; ?></td>
                <td><?php echo $this->roba->detalji->roba_vrsta; ?></td>
                <td><?php echo $this->roba->detalji->roba_kolicina; ?></td>
                <td><?php echo date('d/m/Y', strtotime($this->roba->detalji->roba_datum_evidentiranja)); ?></td>
                <td><img src="<?php echo URL; ?>libs/Barcode.php?$code_type=code128&text=<?php echo $this->roba->detalji->roba_barkod; ?>&print=true" height="90" width="180"/></td>
                <td>
                    <p><?php echo $this->roba->detalji->magacin_naziv; ?></p>
                    <i class="fas fa-arrow-down"></i>
                    <p><?php echo $this->roba->detalji->prostorija_broj; ?></p>
                    <i class="fas fa-arrow-down"></i>
                    <p><?php echo $this->roba->detalji->polica_broj; ?></p> 
                    <i class="fas fa-arrow-down"></i>
                    <p><?php echo $this->roba->detalji->red_broj; ?></p>
                    <i class="fas fa-arrow-down"></i>
                    <p><?php echo $this->roba->detalji->sekcija_broj; ?></p>
                </td>
            </tr>
        </tbody>

    </table>

</div>


<h3>Istorija promena:</h3>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Datum ulaska</th>
            <th scope="col">Sekcija iz koje se premesta</th>
            <th scope="col">Sekcija u koju se premesta</th>        
            <th scope="col">Odobrila osoba</th>
        </tr>

        <?php $i=1;
            foreach ($this->roba->istorija_promena as $istorija) {
        ?>    
            <tr> 
                <th scope="row"><?php echo $i++; ?></th>    
                <td><?php echo date('d/m/Y', strtotime($istorija['datum_unosa'])); ?></td>
                <td><?php echo $istorija['adr_kod_start'] ?></td>            
                <td><?php echo $istorija['adr_kod_kraj'] ?></td>
                <td><?php echo $istorija['ime'] . ' ' . $istorija['prezime'] ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<td>
    <a class="btn btn-info" href="<?php echo URL; ?>roba/prebaciRobu/<?php echo $this->roba->detalji->roba_id; ?>">Prebaci robu</a>
</td>
<td>
    <a class="btn btn-danger" href="<?php echo URL; ?>roba/IznesiRobuIzMagacina/<?php echo $this->roba->detalji->roba_id; ?>">Iznesi robu iz magacina</a>
</td>


<?php
require 'views/dashboard/footer.php';
?>

