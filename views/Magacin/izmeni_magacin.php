<?php
require 'views/dashboard/header.php';
?>

<header>
    <h2>Izmena magacina</h2>
</header>

<form action="<?php echo URL; ?>magacin/izmeniMagacin" method="post" id="izmeni-magacin">
    <input type="hidden" name="magacin_id" value="<?php echo $this->magacin_id; ?>" />
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Naziv</span>
        </div>
        <input type="text" name="naziv" class="form-control" id="naziv" required  aria-describedby="basic-addon3">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Adresa</span>
        </div>
        <input type="text" name="adresa" class="form-control" id="adresa" required  aria-describedby="basic-addon3">
    </div> 
    <button type="submit" class="btn btn-info">
        Izmeni
    </button>
</form>
<script>
    prepare_for_validation(['naziv', 'adresa'], 'izmeni-magacin');
</script>
<a class="btn btn-danger" href="<?php echo URL; ?>magacin/index">Vrati se na magacin</a>
<?php
require 'views/dashboard/footer.php';
?>