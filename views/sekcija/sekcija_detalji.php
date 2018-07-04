<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Sekcija detalji</h2>
</header>
<label>Naziv magacina: <?php echo $this->sekcija->red->polica->prostorija->magacin->naziv;?></label>
<br/>
<label>Adresa magacina:<?php echo $this->sekcija->red->polica->prostorija->magacin->adresa;?></label>
<br/>
<label>Broj prostorije:<?php echo $this->sekcija->red->polica->prostorija->broj;?></label>
<br
<label>Broj police:<?php echo $this->sekcija->red->polica->broj;?></label>
<br/>
<label>Broj reda:<?php echo $this->sekcija->red->broj;?></label>
<br/>
<label>Broj sekcije:<?php echo $this->sekcija->broj;?></label>
<br/>
<label>Spisak robe u sekciji</label>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <td scope="col">Naziv</td>
            <td scope="col">Vrsta robe</td>
            <td scope="col">Datum evidentiranja</td>
            <td scope="col">Kolicina</td>
        </tr>
        </thead>
        <tbody>
        <?php $i=1;
        foreach ($this->sekcija->roba as $roba) {
            ?>    
            <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $roba['naziv'] ?></td>
                <td><?php echo $roba['vrsta_robe'] ?></td> 
                <td><?php echo date('d/m/Y', strtotime($roba['datum_evidentiranja_at'])) ?></td>
                <td><?php echo $roba['kolicina'] ?></td>  
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<a href="<?php echo URL;?>red/redDetalji/<?php echo $this->sekcija->red->id;?>" class="btn btn-info">Vrati se na red</a>
<br/>
<?php
require 'views/dashboard/footer.php';
?>