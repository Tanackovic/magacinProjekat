<?php
require 'views/dashboard/header.php';
?>
<header>
    <h2>Promeni cenu magacina</h2>
</header>
    <form action="<?php echo URL;?>cena/promeniCenuCuvanja" method="post" id="promeni-cenu">      
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">Nova cena:</span>
        </div>
        <input type="number" step="0.01" name="cena" id="cena" class="form-control" required  aria-describedby="basic-addon3">
    </div> 
        <button type="submit" class="btn btn-warning">Promeni cenu</button>
    </form>
<script type="text/javascript">
    prepare_for_validation(['cena'], 'promeni-cenu');
</script>
<?php
require 'views/dashboard/footer.php';
?>
