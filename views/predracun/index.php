<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Pregled predracuna</h2>
</header>
<div class="table-responsive">
<table class="table">
    <thead>
    <tr>
        <th scope="col">Jedinstveni broj predracuna</th>
        <th scope="col">Delovodni broj otpremnice</th>
        <th scope="col">Datum</th>
        <th scope="col">Broj dana</th>        
        <th scope="col">Suma</th>
        <th scope="col">Akcija</th>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($this->predracuni as $predracun) {
    ?>    
        <tr>     
            <td><?php echo $predracun['jedinstveni_broj']; ?></td>
            <td><?php echo $predracun['delovodni_broj_otpremnice']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($predracun['datum_at'])) ?></td>            
            <td><?php echo $predracun['broj_dana'] ?></td>
            <td><?php echo $predracun['totalna_suma'] ?></td>
            <td><a class="btn btn-warning" href="<?php echo URL;?>predracun/predracunDetalji/<?php echo $predracun['predracun_id'];?>">Detalji</a></td>
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
