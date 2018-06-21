<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Polica detalji</h2>
</header>
<label>Naziv magacina: <?php echo $this->polica->prostorija->magacin->naziv;?></label>
<br/>
<label>Adresa magacina:<?php echo $this->polica->prostorija->magacin->adresa;?></label>
<br/>
<label>Broj prostorije:<?php echo $this->polica->prostorija->broj;?></label>
<br>
<label>Broj police:<?php echo $this->polica->broj;?></label>
<br/>
<label>Spisak redova police</label>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <td scope="col">Broj</td>
                <td scope="col">Akcije</td>
            </tr>
        </thead>
        <tbody>
        <?php $i=1;
        foreach ($this->polica->redovi as $redovi) {
            ?>    
            <tr>
                <th><?php echo $i++; ?></th>
                <td><?php echo $redovi['red_broj'] ?></td>
                <td>
                    <a href="<?php echo URL; ?>red/redDetalji/<?php echo $redovi['id']; ?>" class="btn btn-warning">Detalji</a>
                    <a href="<?php echo URL; ?>red/izmenaReda/<?php echo $redovi['id']; ?>" class="btn btn-danger">Izmeni</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<a href="<?php echo URL;?>prostorija/prostorijaDetalji/<?php echo $this->polica->prostorija->id;?>" class="btn btn-danger">Vrati se na prostoriju</a>
<br/>
<a href="<?php echo URL;?>red/noviRed/<?php echo $this->polica->id;?>" class="btn btn-info">Dodaj novi red</a>
<?php
require 'views/dashboard/footer.php';
?>