<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Predracun</h2>
</header>
<label>Jedinstveni broj predracuna</label>
<label><?php echo $this->predracun->predracun['jedinstveni_broj']; ?></label>
<br/>
<label>Delovodni broj otpremnice</label>
<label><?php echo $this->predracun->predracun['delovodni_broj_otpremnice']; ?></label>
<br/>
<label>Datum</label>
<label><?php echo $this->predracun->predracun['datum']; ?></label>
<br/>
<label>Vreme lezanja</label>
<label><?php echo $this->predracun->predracun['broj_dana']; ?> dana</label>
<br/>
<label>Totalna suma</label>
<label><?php echo $this->predracun->predracun['totalna_suma']; ?></label>
<br/>
<label>Stavke predracuna:</label>
<div class="table-responsive">
<table class="table">
    <thead> 
    <tr>
        <th scope="col">Datum od</th>
        <th scope="col">Datum do</th>
        <th scope="col">Cena po danu</th>
        <th scope="col">Broj dana</th>        
        <th scope="col">Suma za dane</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($this->predracun->stavke_predracuna as $stavke) {
        ?>    
        <tr>     
            <td><?php echo date('d/m/Y', strtotime($stavke['datum_od'])); ?></td>
            <td><?php echo date('d/m/Y', strtotime($stavke['datum_do'])); ?></td>            
            <td><?php echo $stavke['cena_po_danu'] ?></td>            
            <td><?php echo $stavke['broj_dana'] ?></td>
            <td><?php echo $stavke['total_cena_za_dane'] ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</div>
<?php
require 'views/dashboard/footer.php';
?>

