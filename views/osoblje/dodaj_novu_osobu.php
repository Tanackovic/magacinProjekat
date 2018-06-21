<?php
require 'views/dashboard/header.php';
?>

<header>
    <h2>Dodavanje novog korisnika</h2>
</header>

<form action="<?php echo URL; ?>osoba/dodajNovuOsobu" method="post" id="dodaj-osobu">
    <p>Dodaj novu osobu</p>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Ime:</span>
        </div>
        <input type="text" name="ime" class="form-control" id="ime" required  aria-describedby="basic-addon3">
    </div> 
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Prezime:</span>
        </div>
        <input type="text" name="prezime" class="form-control" id="prezime" required  aria-describedby="basic-addon3">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Korisnicko ime:</span>
        </div>
        <input type="text" name="korisnicko_ime" class="form-control" id="korisnicko_ime" required  aria-describedby="basic-addon3">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Password:</span>
        </div>
        <input type="password" name="password" class="form-control" id="password" required  aria-describedby="basic-addon3">
    </div>

    <label>Uloga:</label>
    <select id="uloga" name="uloga" required class="custom-select" >
        <option value="0">Izaberi ulogu</option>
        <option value="1">Administrator</option>
        <option value="2">Korisnik</option>
    </select>
    <br/>
    <button type="submit" class="btn btn-info">
        Dodaj korisnika
    </button>
</form>
<script >
   prepare_for_validation(['ime', 'prezime','korisnicko_ime','password','uloga'], 'dodaj-osobu');
</script>
<?php
require 'views/dashboard/footer.php';
?>