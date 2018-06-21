<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Izmeni red</h2>
</header>
<form action="<?php echo URL; ?>red/izmeniRed" method="post" id="izmeni-red">
    <input type="hidden" name="red_id" value="<?php echo $this->red_id; ?>" />
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Broj</span>
        </div>
        <input type="text" name="broj" class="form-control" id="broj" required  aria-describedby="basic-addon3">
    </div>
    <button type="submit" class="btn btn-info">Izmeni red</button>
</form>
<script>
    prepare_for_validation(['broj'], 'izmeni-red');
</script>
<?php
require 'views/dashboard/footer.php';
?>
