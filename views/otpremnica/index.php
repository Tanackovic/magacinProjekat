<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Pregled otpremnica</h2>
</header>
<div class="table-responsive">
<table class="table">
    <thead>
    <tr>
        <th scope="col">Delovodni broj otpremnice</th>
        <th scope="col">Delovodni broj prijemnog lista</th>
        <th scope="col">Datum</th>
        <th scope="col">Vreme lezanja</th>        
        <th scope="col">Akcija</th>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($this->otpremnice as $otpremnica) {
    ?>    
        <tr>     
            <td><?php echo $otpremnica['delovodni_broj_otpremnice']; ?></td>
            <td><?php echo $otpremnica['delovodni_broj_prijemnog_lista']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($otpremnica['datum_at'])) ?></td>            
            <td><?php echo $otpremnica['vreme_lezanja_u_danima'] ?></td>
            <td><a class="btn btn-warning" href="<?php echo URL;?>otpremnica/otpremnicaDetalji/<?php echo $otpremnica['otpremni_list_id'];?>">Detalji</a></td>
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
