<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Otpremni list</h2>
</header>
    <label>Delovodni broj otpremnice</label>
    <label><?php echo $this->otpremnica->otpremnica['delovodni_broj_otpremnice'];?></label>
    <br/>
    <label>Delovodni broj prijemnog lista</label>
    <label><?php echo $this->otpremnica->otpremnica['delovodni_broj_prijemnog_lista'];?></label>
    <br/>
    <label>Datum</label>
    <label><?php echo date('d/m/Y', strtotime($this->otpremnica->otpremnica['datum_at']));?></label>
    <br/>
    <label>Vreme lezanja</label>
    <label><?php echo $this->otpremnica->otpremnica['vreme_lezanja_u_danima'];?> dana</label>
    <br/>
    <label>Istorija promena:</label>
    <div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Datum ulaska</th>
            <th scope="col">Sekcija iz koje se premesta</th>
            <th scope="col">Sekcija u koju se premesta</th>        
            <th scope="col">Odobrila osoba</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach ($this->otpremnica->stavke_otpremnice as $stavke) {
        ?>    
            <tr>     
                <td><?php echo date('d/m/Y', strtotime($stavke['datum_unosa_at'])); ?></td>
                <td><?php echo $stavke['adr_kod_start'] ?></td>            
                <td><?php echo $stavke['adr_kod_kraj'] ?></td>
                <td><?php echo $stavke['ime'] . ' ' . $stavke['prezime'] ?></td>
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

