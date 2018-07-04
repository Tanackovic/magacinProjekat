<?php
require 'views/dashboard/header.php';
?>

<header>
    <h2>Arhiviraj osobu</h2>
</header>

<form action="<?php echo URL; ?>osoba/arhivirajOsobu" method="post">
    <input type="hidden" name="id" value="<?php echo $this->osoba['osoba_id'] ?>">
    <p>Osoba</p>
    <label>Ime: <?php echo $this->osoba['ime'] ?></label>
    <br/>
    <label>Prezime:<?php echo $this->osoba['prezime'] ?></label>
    <br/>
    <label>Korisnicko ime: <?php echo $this->osoba['korisnicko_ime'] ?></label>
    <br/>
    <?php if($this->osoba['uloga']){?>
    <label>Uloga:Administrator</label>
    <?php } else {?>
    <label>Uloga:Radnik</label>
    <?php } ?>
    <br/>
    <button type="submit" class="btn btn-info">
        Arhiviraj osobu
    </button>
</form>
<?php
require 'views/dashboard/footer.php';
?>