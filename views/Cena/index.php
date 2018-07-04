<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Pregled svih promena cena</h2>
</header>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Datum aktivacije</th>
                <th scope="col">Datum deaktivacije</th>
                <th scope="col">Cena</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($this->cene as $cena){
            ?>
            <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <th scope="row"><?php echo date('d/m/Y', strtotime($cena['datum_aktivacije_at'])); ?></th>
                <th scope="row"><?php echo (date('d/m/Y', strtotime($cena['datum_deaktivacije_at'])) === '01/01/1970')? "":date('d/m/Y', strtotime($cena['datum_deaktivacije_at'])); ?></th>
                <th scope="row" class="price"><?php echo number_format($cena['cena'], 2); ?></th>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<a class="btn btn-info" href="<?php echo URL; ?>cena/promeniCenu">Promeni cenu</a>


<?php
require 'views/dashboard/footer.php';
?>