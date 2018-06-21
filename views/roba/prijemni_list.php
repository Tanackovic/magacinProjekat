<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Prijemni list</h2>
</header>

<div class="table-responsive">
    <table class="table">

        <thead>
            <tr>
                <th scope="col">Delovodni broj</th>
                <th scope="col">Datum</th>
                <th scope="col">Lokacija</th>
                <th scope="col">Kolicina</th>
                <th scope="col">Naziv</th>
                <th scope="col">Barkod</th>
                <th scope="col">Vrsta robe</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><?php echo $this->prijemniList->prijemni_list_db;?></td>
                <td><?php echo $this->prijemniList->prijemni_list_datum;?></td>
                <td>
                    <p><?php echo $this->prijemniList->magacin_naziv;?></p><i class="fas fa-arrow-down"></i>
                    <p><?php echo $this->prijemniList->prostorija_broj;?></p><i class="fas fa-arrow-down"></i>
                    <p><?php echo $this->prijemniList->polica_broj;?></p><i class="fas fa-arrow-down"></i>
                    <p><?php echo $this->prijemniList->red_broj;?></p><i class="fas fa-arrow-down"></i>
                    <p><?php echo $this->prijemniList->sekcija_broj;?></p>
                </td>
                <td><?php echo $this->prijemniList->roba_kolicina;?></td>
                <td><?php echo $this->prijemniList->roba_naziv;?></td>
                <td><img src="<?php echo URL;?>libs/Barcode.php?$code_type=code128&text=<?php echo $this->prijemniList->roba_barkod;?>&print=true" height="90" width="180"/></td>
                <td><?php echo $this->prijemniList->roba_vrsta;?></td>
            </tr>
        </tbody>

    </table>
</div>

<?php
require 'views/dashboard/footer.php';
?>

