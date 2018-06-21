<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Izmeni prostoriju</h2>
</header>
<form action="<?php echo URL; ?>prostorija/izmeniProstoriju" method="post" id="izmeni-prostoriju">
    <input type="hidden" name="prostorija_id" value="<?php echo $this->prostorija_id; ?>" />
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Broj</span>
        </div>
        <input type="text" name="broj" class="form-control" id="broj" required  aria-describedby="basic-addon3">
    </div>
    <button class="btn btn-warning" type="submit">Izmeni prostoriju</button>
</form>
<script>
    prepare_for_validation(['broj'], 'izmeni-prostoriju');
</script>
<?php
require 'views/dashboard/footer.php';
?>
