<?php
require 'views/dashboard/header.php';
?>
<h1>Prostorija detalji</h1>
<br/>
<label>Naziv magacina: <?php echo $this->prostorija->magacin->naziv;?></label>
<br/>
<label>Adresa magacina:<?php echo $this->prostorija->magacin->adresa;?></label>
<br/>
<label>Broj prostorije:<?php echo $this->prostorija->broj;?></label>
<br/>
<label>Spisak polica u prostoriji</label>
<div class="table-responsive">
    <table class="table">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Broj</th>
            <th scope="col">Akcije</th>
        </tr>

        <?php $i=1;
        foreach ($this->prostorija->police as $polica) {
            ?>    
            <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $polica['polica_broj'] ?></td>
                <td>
                    <a href="<?php echo URL; ?>polica/policaDetalji/<?php echo $polica['id']; ?>" class="btn btn-warning">Detalji</a>
                    <a href="<?php echo URL; ?>polica/izmenaPolice/<?php echo $polica['id']; ?>" class="btn btn-danger">Izmeni</a>
                </td>
                
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<br/>
<a href="<?php echo URL;?>magacin/magacinDetalji/<?php echo $this->prostorija->magacin->id;?>" class="btn btn-danger">Vrati se na magacin</a>
<br/>
<a href="<?php echo URL;?>polica/novaPolica/<?php echo $this->prostorija->id;?>" class="btn btn-info">Dodaj novu policu</a>
<?php
require 'views/dashboard/footer.php';
?>