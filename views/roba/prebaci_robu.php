<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Prebaci robu</h2>
</header>
<form action="<?php echo URL; ?>roba/prebaciRobuUDruguSekciju" method="post">
    <input type="hidden" name="sekcija_start" value="<?php echo $this->sekcija->sekcija_id;?>"/>
    <input type="hidden" name="roba_id" value="<?php echo $this->sekcija->roba_id;?>"/>
    
    <label>Naziv:</label>
    <label><?php echo $this->sekcija->roba_naziv;?></label>
    <br/>
    <label>Vrsta robe:</label>    
    <label><?php echo $this->sekcija->roba_vrsta;?></label>
    <br/>
    <label>Kolicina:</label>
    <label><?php echo $this->sekcija->roba_kolicina;?></label>
    <br/>
    <br/>
    <label>Prebaci robu u:</label>
    <br/>
    <label>Magacin:</label>
    <select name="magacin" id="magacin" class="custom-select" required></select>
    <br/>
    <label>Prostorija:</label>
    <select name="prostorija" id="prostorija" class="custom-select" required></select>
    <br/>
    <label>Polica:</label>
    <select name="polica" id="polica" class="custom-select" required></select>
    <br/>
    <label>Red:</label>
    <select name="red" id="red" class="custom-select" required></select>
    <br/>
    <label>Sekcija:</label>
    <select name="sekcija" id="sekcija" class="custom-select" required></select>
    <br/><br>
    <button type="submit" class="btn btn-info">Prebaci robu</button>
</form>

<?php
require 'views/dashboard/footer.php';
?>

