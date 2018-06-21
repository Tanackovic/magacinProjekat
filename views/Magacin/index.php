<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Pregled svih magacina</h2>
</header>
<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Naziv Magacina</th>
            <th scope="col">Adresa</th>
            <th scope="col">Akcije</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1;
    foreach ($this->magacini as $magacin) {
        ?>    
        <tr>
            <th scope="row"><?php echo $i++; ?></th>
            <td><?php echo $magacin['magacin_naziv']; ?></td>
            <td><?php echo $magacin['adresa']; ?></td>
            <td>
                <a class="btn btn-warning" href="<?php echo URL; ?>magacin/magacinDetalji/<?php echo $magacin['id']; ?>">Detalji</a>
                <a class="btn btn-danger" href="<?php echo URL; ?>magacin/izmenaMagacina/<?php echo $magacin['id']; ?>">Izmeni</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</div>
<a class="btn btn-info" href="<?php echo URL;?>magacin/noviMagacin">Dodaj novi magacin</a>



<?php
require 'views/dashboard/footer.php';
?>