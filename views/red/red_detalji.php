<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Red detalji</h2>
</header>
<label>Naziv magacina: <?php echo $this->red->polica->prostorija->magacin->naziv;?></label>
<br/>
<label>Adresa magacina:<?php echo $this->red->polica->prostorija->magacin->adresa;?></label>
<br/>
<label>Broj prostorije:<?php echo $this->red->polica->prostorija->broj;?></label>
<br
<label>Broj police:<?php echo $this->red->polica->broj;?></label>
<br/>
<label>Broj reda:<?php echo $this->red->broj;?></label>
<br/>
<label>Spisak sekcija u redu</label>
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
        foreach ($this->red->sekcije as $sekcija) {
            ?>    
            <tr>
                <th scope="row"><?php echo $i++ ?></th>
                <td><?php echo $sekcija['sekcija_broj'] ?></td>
                <td>
                    <a href="<?php echo URL; ?>sekcija/sekcijaDetalji/<?php echo $sekcija['id']; ?>" class="btn btn-warning">Detalji</a>
                    <a href="<?php echo URL; ?>sekcija/izmenaSekcije/<?php echo $sekcija['id']; ?>" class="btn btn-danger">Izmeni</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
<a href="<?php echo URL;?>polica/policaDetalji/<?php echo $this->red->polica->id;?>" class="btn btn-danger">Vrati se na policu</a>
<br/>
<a href="<?php echo URL;?>sekcija/novaSekcija/<?php echo $this->red->id;?>" class="btn btn-info">Dodaj novu sekciju</a>
<?php
require 'views/dashboard/footer.php';
?>