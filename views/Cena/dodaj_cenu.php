<?php
require 'views/dashboard/header.php';
?>
<form action="<?php echo URL; ?>cena/dodajCenu" method="post" id="dodaj-cenu">
    <p>Dodaj cenu magacina</p>
    <label>Nova cena:</label>
    <input type="number" step="0.01" name="cena" id="cena" class="required"/>
    <br/>
    <button type="submit" class="btn btn-info">Dodaj pocetnu cenu</button>
</form>
<script type="text/javascript">
    prepare_for_validation(['cena'], 'dodaj-cenu');
</script>
<?php
require 'views/dashboard/footer.php';
?>
