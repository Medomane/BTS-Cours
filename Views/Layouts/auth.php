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

    <script type="text/javascript" src='<?=WEBROOT."node_modules/jquery/dist/jquery.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/popper.js/dist/popper.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/bootstrap/dist/js/bootstrap.js" ?>'></script>
    <script type="text/javascript" src='<?= WEBROOT."node_modules/sweetalert2/dist/sweetalert2.js" ?>'></script>
    <script type="text/javascript" src='<?= WEBROOT."node_modules/multiple-select/dist/multiple-select.min.js" ?>'></script>
    <script type="text/javascript" src='<?= WEBROOT."node_modules/jquery.fancytree/dist/jquery.fancytree-all-deps.min.js" ?>'></script>
    <script type="text/javascript" src='<?= WEBROOT."js/bstreeview.min.js" ?>'></script>

    <script type="text/javascript" src='<?=WEBROOT."js/JavaScript.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."js/SweetAlert.js" ?>'></script>
</head>

<body>
    <?php
        echo $content_for_layout;
    ?>
</body>
</html>
