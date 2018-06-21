<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Pregled svih osoba</h2>
</header>
<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ime</th>
            <th scope="col">Prezime</th>
            <th scope="col">Korisnicko ime</th>
            <th scope="col">Uloga</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1;
    foreach ($this->osoblje as $osoba) {
        ?>    
        <tr>
            <th scope="row"><?php echo $i++; ?></th>
            <td><?php echo $osoba['ime']; ?></td>
            <td><?php echo $osoba['prezime']; ?></td>
            <td><?php echo $osoba['korisnicko_ime']; ?></td>
            <?php if($osoba['uloga'] == 1){ ?>
                <td>Administrator</td>
            <?php } else { ?>    
                <td>Radnik</td>
            <?php } ?>
            <td>
                <a class="btn btn-warning" href="<?php echo URL; ?>osoba/arhivaOsobe/<?php echo $osoba['id']; ?>">Arhiviraj osobu</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
</div>
<a class="btn btn-info" href="<?php echo URL;?>osoba/NovaOsoba">Dodaj novu osobu</a>
<?php
require 'views/dashboard/footer.php';
?>
