<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Dodaj novu robu</h2>
</header>
<form action="<?php echo URL; ?>roba/dodajNovuRobu" method="post" id="dodaj-robu">
    <label>Magacin:</label>
    <select name="magacin" id="magacin" required class="custom-select"></select>
    <br/>
    <label>Prostorija:</label>
    <select name="prostorija" id="prostorija" required class="custom-select"> </select>
    <br/>
    <label>Polica:</label>
    <select name="polica" id="polica" required class="custom-select" ></select>
    <br/>
    <label>Red:</label>
    <select name="red" id="red" required class="custom-select"></select>
    <br/>
    <label>Sekcija:</label>
    <select name="sekcija" id="sekcija" required class="custom-select"></select>
    <br/>    
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Kolicina</span>
        </div>
        <input type="number" name="kolicina" class="form-control" id="kolicina" required  aria-describedby="basic-addon3">
    </div>    
    <br/>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Naziv</span>
        </div>
        <input type="text" name="naziv" class="form-control" id="naziv" required  aria-describedby="basic-addon3">
    </div> 
    <br/>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Vrsta robe</span>
        </div>
        <input type="text" name="vrsta_robe" class="form-control" id="vrsta_robe" required  aria-describedby="basic-addon3">
    </div> 
    <br/>
    <button type="submit" class="btn btn-info">Dodaj novu robu</button>
</form>
<?php
require 'views/dashboard/footer.php';
?>

