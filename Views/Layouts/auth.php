<!doctype html>
<head>
    <meta charset="UTF-8"/>
    <title>BTS Courses</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0"/>
    <link rel="shortcut icon" href='<?= ROOT."favicon.ico" ?>' type="image/x-icon">
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."css/style.css" ?>'/>

    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/bootstrap/dist/css/bootstrap.css" ?>'/>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/@fortawesome/fontawesome-free/css/all.css" ?>'/>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/sweetalert2/dist/sweetalert2.css" ?>'/>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/multiple-select/dist/multiple-select.min.css" ?>'>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/jquery.fancytree/dist/skin-win8/ui.fancytree.min.css" ?>'>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."css/bstreeview.min.css" ?>'>
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />

    <script type="text/javascript" src='<?=WEBROOT."node_modules/jquery/dist/jquery.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/popper.js/dist/popper.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/bootstrap/dist/js/bootstrap.js" ?>'></script>
    <script type="text/javascript" src='<?= WEBROOT."node_modules/sweetalert2/dist/sweetalert2.js" ?>'></script>
    <script type="text/javascript" src='<?= WEBROOT."node_modules/multiple-select/dist/multiple-select.min.js" ?>'></script>
    <script type="text/javascript" src='<?= WEBROOT."node_modules/jquery.fancytree/dist/jquery.fancytree-all-deps.min.js" ?>'></script>
    <script type="text/javascript" src='<?= WEBROOT."js/bstreeview.min.js" ?>'></script>
    
    
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <script type="text/javascript" src='<?=WEBROOT."js/JavaScript.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."js/SweetAlert.js" ?>'></script>
   
    <style>
        .nav-link , .navbar-brand{
            color: #f4f4f4; 
            cursor: pointer;
        }
        .nav-link{
            margin-right: 1em !important;
        }
        .nav-link:hover{
            color: #f97300;
        }
        .navbar-collapse{
            justify-content: flex-end;
        }
        
    </style>
</head>

<body id="page-top">
    <!--<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top" style="letter-spacing: 12px;">BTS</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0 ">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href='<?= ROOT.'auths/login' ?>' >Sign In</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href='<?= ROOT.'auths/register' ?>' >Sign Up</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about" >About</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services" >Services</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact" >Contact</a></li>
                <li class="nav-item"><a  class="nav-link " data-value="référentiels" href="https://e-bts.men.gov.ma/Fr/Organistation/Pages/R%C3%A9f%C3%A9rentiels%20de%20formation.aspx">Référentiels</a></li>
            </ul>
        </div>
    </div>
</nav>-->
    <?php
        echo $content_for_layout;
    ?>
    </div>
</body>
</html>
