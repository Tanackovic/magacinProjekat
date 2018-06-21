<?php
require 'views/dashboard/header.php';
?>

<header>
    <h2>Dodavanje novog magacina</h2>
</header>

        <form action="<?php echo URL;?>magacin/dodajNoviMagacin" method="post" id="dodaj-novi-magacin">
            <p>Dodaj novi magacin</p>
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
                Dodaj
            </button>
        </form>

        <a class="btn btn-danger" href="<?php echo URL;?>magacin/index">Vrati se na magacin</a>
        
        <script>
            prepare_for_validation(['naziv', 'adresa'], 'dodaj-novi-magacin');
        </script>
<?php
require 'views/dashboard/footer.php';
?>