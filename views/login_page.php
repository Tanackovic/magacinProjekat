<html>
    <head>
        <title>Magacin Login page</title>
        <link rel="stylesheet" href="<?php echo URL;?>public/css/screen.css" />
        <script type="text/javascript" src="<?php echo URL;?>public/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo URL;?>public/js/custom-dist.js"></script>
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 offset-sm-3">
            <h2 style="padding-top: 30px;">Dobrodosli u softver za evidenciju robe</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 offset-sm-3">
            <form  action="login/loginIn" method="post">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Username:</span>
                        </div>
                        <input type="text" name="username" class="form-control" id="username" required  aria-describedby="basic-addon3">
                    </div>         
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Password:</span>
                        </div>
                        <input type="password" name="password" class="form-control" id="password" required  aria-describedby="basic-addon3">
                    </div> 
                </div>
                <button type="submit" class="btn btn-primary"> Log In <span><i class="fas fa-sign-out-alt"></i></span></button>
            </form> 
            </div>
        </div>
    </div>
 
    </body>
</html>
