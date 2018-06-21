<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Magacin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo URL;?>public/css/screen.css" />
        <script src="<?php echo URL;?>public/js/jquery.js"></script>
        <script src="<?php echo URL;?>public/js/validation.js"></script>
        <script src="<?php echo URL;?>public/js/bootstrap.js"></script>
        <?php
            if(isset($this->js)){
                foreach ($this->js as $js){
                    echo '<script  src="'.URL.'views/'.$js.'"></script>';
                }
            }
        ?>
        <style>
        .validation-warning{
            position: absolute;
            top: -30px;
            right: 0;
            padding: 4px;
            font-size: 12px;
            background: #000;
            color: #fff;
        }
        .validation-warning span{
            position: absolute;
            bottom: -5px;
            left: 50%;
            margin-left: -3px;
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid black;
        }
        .form-wrapper input.error-icon,
        .error-icon{
            background-image: url(../../images/icon-fail.png);
            background-repeat: no-repeat;
            background-position: right 7px;
        }
    </style>
    </head>
    <body>
        <?php Session::init(); ?>
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="logged-person">
                        Logged in as:
                        <label><?php echo $_SESSION['osoba'];?></label>                      
                    </div>        
                    <div id="header">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li><a href="<?php echo URL;?>dashboard/index">Pocetna</a></li>
                                    <li><a href="<?php echo URL;?>magacin/index">Magacin</a></li>
                                    <li><a href="<?php echo URL;?>roba/novaRoba">Roba</a></li>
                                    <li><a href="<?php echo URL;?>otpremnica/index">Otpremnice</a></li>
                                    <li><a href="<?php echo URL;?>predracun/index">Predracuni</a></li>
                                    <li><a href="<?php echo URL;?>cena/index">Cene</a></li>
                                    <?php if($_SESSION['uloga'] == 1) { ?>
                                    <li><a href="<?php echo URL;?>osoba/index">Korisnicki servis</a></li>
                                    <?php }?>
                                    <li><a href="<?php echo URL;?>dashboard/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                </ul>

                            </div>
                        </nav>    
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <h4>Brza pretraga</h4>
                    <form class="form-inline my-2 my-lg-0" action="<?php echo URL;?>dashboard/index" method="post">
                        
                        <input name="filter" class="form-control mr-sm-2" type="search" placeholder="Unesi artikal" aria-label="Search">                        
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pronadji</button>
                    </form>  
                </div>
            </div>
        </div>

        <div id="content">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12">

