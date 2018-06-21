<?php
require 'views/dashboard/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Naziv robe</th>
                            <th scope="col">Kolicina</th>
                            <th scope="col">Pozicija robe</th>
                            <th scope="col">Barkod</th>
                            <th scope="col">Osoba</th>
                            <th scope="col">Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($this->roba as $roba) {?>    
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><?php echo $roba['naziv']; ?></td>
                                <td><?php echo $roba['kolicina']; ?></td>
                                <td><?php echo $roba['adresa']; ?></td>
                                <td><img src="<?php echo URL; ?>libs/Barcode.php?$code_type=code128&text=<?php echo $roba['barkod']; ?>&print=true" height="90" width="180" alt="barcode"/></td>
                                <td><?php echo $roba['ime_prezime']; ?></td>
                                <td>
                                    <a class="btn btn-info" href="<?php echo URL; ?>roba/robaDetalji/<?php echo $roba['id']; ?>">Detalji</a>
                                    <a class="btn btn-success" href="<?php echo URL; ?>roba/prijemniList/<?php echo $roba['id']; ?>">Prijemni list</a>
                                    <a class="btn btn-warning" href="<?php echo URL; ?>roba/prebaciRobu/<?php echo $roba['id']; ?>">Prebaci robu</a>
                                    <a class="btn btn-danger" href="<?php echo URL; ?>roba/iznesiRobu/<?php echo $roba['id']; ?>">Izlaz robe</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php
require 'views/dashboard/footer.php';
?>