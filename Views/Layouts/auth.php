<!doctype html>
<head>
    <meta charset="UTF-8"/>
    <title>Cours</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0"/>

    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."CSS/style.css" ?>'/>

    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/bootstrap/dist/css/bootstrap.css" ?>'/>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/@fortawesome/fontawesome-free/css/all.css" ?>'/>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/sweetalert2/dist/sweetalert2.css" ?>'/>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/multiple-select/dist/multiple-select.min.css" ?>'>

    <script type="text/javascript" src='<?=WEBROOT."node_modules/jquery/dist/jquery.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/popper.js/dist/popper.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/bootstrap/dist/js/bootstrap.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/sweetalert2/dist/sweetalert2.js" ?>'></script>
    <script type="text/javascript" src='<?= WEBROOT."node_modules/multiple-select/dist/multiple-select.min.js" ?>'></script>

    <script type="text/javascript" src='<?=WEBROOT."JS/JavaScript.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."JS/SweetAlert.js" ?>'></script>
</head>

<body>
    <?php
        echo $content_for_layout;
    ?>
</body>
</html>
