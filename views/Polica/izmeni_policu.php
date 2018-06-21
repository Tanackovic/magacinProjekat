<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Izmena police</h2>
</header> 
<form action="<?php echo URL; ?>polica/izmeniPolicu" method="post" id="izmeni-policu">
    <input type="hidden" name="polica_id" value="<?php echo $this->polica_id; ?>" />
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Broj</span>
        </div>
        <input type="text" name="broj" class="form-control" id="broj" required  aria-describedby="basic-addon3">
    </div>
    <button type="submit" class="btn btn-info">Izmeni policu</button>
</form>
<script>
    prepare_for_validation(['broj'], 'izmeni-policu');
</script>
<?php
require 'views/dashboard/footer.php';
?>
