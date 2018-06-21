var genurl = "http://localhost:8080/MagacinProjekat/";
function loadMagacin() {
        url =  genurl + "magacin/PopuniKombo";
        $('#magacin').empty();
        $('#magacin').append("<option>Loading...</option>");
        $('#prostorija').append("<option>Loading...</option>");
        $('#polica').append("<option>Loading...</option>");
        $('#red').append("<option>Loading...</option>");
        $('#sekcija').append("<option>Loading...</option>");
        $.ajax({
            type: "POST",
            url: url,
            contenttype: "aplication/json; charset:utf=8",
            success: function (data) {
                $('#magacin').empty();
                $('#magacin').append("<option value='0'>Izaberite magacin...</option>");
                $.each(JSON.parse(data), function (i, item) {
                    $('#magacin').append('<option value="' + item.id + '">' + item.magacin_naziv + '</option>');
                });
            },
            error: function (text) {
            }
        });
    }
    
    function loadProstorije(magacin_id) {
        url =  genurl + "prostorija/PopuniKombo";
        $('#prostorija').empty();
        $('#prostorija').append("<option>Loading...</option>");
        $.ajax({
            type: "POST",
            url: url,
            data: {magacin_id: magacin_id},
            contenttype: "aplication/json; charset:utf=8",
            success: function (data) {
                $('#prostorija').empty();
                $('#prostorija').append("<option value='0'>Izaberite prostoriju...</option>");
                $.each(JSON.parse(data), function (i, item) {
                    $('#prostorija').append('<option value="' + item.id + '">' + item.prostorija_broj + '</option>');
                });
            },
            error: function (text) {
            }
        });
    }
    
    function loadPolice(prostorija_id) {
        url =  genurl + "polica/PopuniKombo";
        $('#polica').empty();
        $('#polica').append("<option>Loading...</option>");
        $.ajax({
            type: "POST",
            url: url,
            data: {prostorija_id: prostorija_id},
            contenttype: "aplication/json; charset:utf=8",
            success: function (data) {
                $('#polica').empty();
                $('#polica').append("<option value='0'>Izaberite policu...</option>");
                $.each(JSON.parse(data), function (i, item) {
                    $('#polica').append('<option value="' + item.id + '">' + item.polica_broj + '</option>');
                });
            },
            error: function (text) {
            }
        });
    }
    
    function loadRedovi(polica_id) {
        url =  genurl + "red/PopuniKombo";
        $('#red').empty();
        $('#red').append("<option>Loading...</option>");
        $.ajax({
            type: "POST",
            url: url,
            data: {polica_id: polica_id},
            contenttype: "aplication/json; charset:utf=8",
            success: function (data) {
                $('#red').empty();
                $('#red').append("<option value='0'>Izaberite red...</option>");
                $.each(JSON.parse(data), function (i, item) {
                    $('#red').append('<option value="' + item.id + '">' + item.red_broj + '</option>');
                });
            },
            error: function (text) {
            }
        });
    }
    
    function loadSekcije(red_id) {
        url =  genurl + "sekcija/PopuniKombo";
        $('#sekcija').empty();
        $('#sekcija').append("<option>Loading...</option>");
        $.ajax({
            type: "POST",
            url: url,
            data: {red_id: red_id},
            contenttype: "aplication/json; charset:utf=8",
            success: function (data) {
                $('#sekcija').empty();
                $('#sekcija').append("<option value='0'>Izaberite sekciju...</option>");
                $.each(JSON.parse(data), function (i, item) {
                    $('#sekcija').append('<option value="' + item.id + '">' + item.sekcija_broj + '</option>');
                });
            },
            error: function (text) {
            }
        });
    }
    
    function loadInicijalnog(){
        loadProstorije(0);
        loadPolice(0);
        loadRedovi(0);
        loadSekcije(0);
    }
    
    $(document).ready(function(){
        loadMagacin();
        $('#magacin').change(function (){
             var magacin_id = $('#magacin').val();
             if(magacin_id !== 0){
                loadProstorije(magacin_id);
             }
             else loadInicijalnog();
        });
        $('#prostorija').change(function (){
             var prostorija_id = $('#prostorija').val();
             loadPolice(prostorija_id);
        });
        $('#polica').change(function (){
             var polica_id = $('#polica').val();
             loadRedovi(polica_id);
        });
        $('#red').change(function (){
             var red_id = $('#red').val();
             loadSekcije(red_id);
        });
    });