<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Dodaj novi red</h2>
</header>
<form action="<?php echo URL; ?>red/dodajNoviRed" method="post" id="dodaj-red">
    <input type="hidden" name="polica_id" value="<?php echo $this->police_id; ?>" />
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Broj</span>
        </div>
        <input type="text" name="broj" class="form-control" id="broj" required  aria-describedby="basic-addon3">
    </div>
    <button type="submit" class="btn btn-info">Dodaj red</button>
</form>
<script>
    prepare_for_validation(['broj'], 'dodaj-red');
</script>
<?php
require 'views/dashboard/footer.php';
?>
