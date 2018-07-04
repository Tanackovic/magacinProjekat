<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Magacin detalji</h2>
</header>
<br/>
<label>Naziv: <?php echo $this->magacin->naziv; ?></label>
<br/>
<label>Adresa:<?php echo $this->magacin->adresa; ?></label>
<br/>
<label>Spisak prostorija u magacinu</label>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Naziv prostorije</th>
                <th scope="col">Akcije</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($this->magacin->prostorije as $prostorija) {
                ?>    
                <tr>
                    <th scope="row"><?php echo $i++; ?></th>
                    <td><?php echo $prostorija['prostorija_broj'] ?></td>
                    <td>
                        <a class="btn btn-warning" href="<?php echo URL; ?>prostorija/prostorijaDetalji/<?php echo $prostorija['prostorija_id']; ?>">Detalji</a>
                        <a class="btn btn-danger" href="<?php echo URL; ?>prostorija/izmenaProstorije/<?php echo $prostorija['prostorija_id']; ?>">Izmeni</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<a class="btn btn-danger" href="<?php echo URL; ?>magacin/index">Vrati se na listu magacina</a>
<br>
<a class="btn btn-info" href="<?php echo URL; ?>prostorija/novaProstorija/<?php echo $this->magacin->id; ?>">Dodaj novu prostoriju</a>
<?php
require 'views/dashboard/footer.php';
?>