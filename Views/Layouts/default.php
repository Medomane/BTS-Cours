<!doctype html>
<head>
    <meta charset="UTF-8"/>
    <title>Cours</title>

    <meta name="viewport" content="width=device-width, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0"/>

    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."CSS/style.css" ?>'/>

    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/bootstrap/dist/css/bootstrap.css" ?>'/>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/@fortawesome/fontawesome-free/css/all.css" ?>'/>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/sweetalert2/dist/sweetalert2.css" ?>'/>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/charts/dist/Chart.css" ?>'/>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."node_modules/multiple-select/dist/multiple-select.min.css" ?>'>
    <link rel="stylesheet" type="text/css" href='<?= WEBROOT."CSS/sideBar.css" ?>'/>

    <script type="text/javascript" src='<?=WEBROOT."node_modules/jquery/dist/jquery.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/popper.js/dist/popper.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/bootstrap/dist/js/bootstrap.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/sweetalert2/dist/sweetalert2.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."node_modules/charts/dist/Chart.js" ?>'></script>
    <script type="text/javascript" src='<?= WEBROOT."node_modules/multiple-select/dist/multiple-select.min.js" ?>'></script>

    <script type="text/javascript" src='<?=WEBROOT."JS/JavaScript.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."JS/SweetAlert.js" ?>'></script>
    <script type="text/javascript" src='<?=WEBROOT."JS/sideBar.js" ?>'></script>
</head>

<body>
    <div class="page-wrapper chiller-theme toggled">
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="<?= ROOT."homes" ?>">BTS Maroc</a>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img src='<?=WEBROOT."img/".AuthUser::Get()["gender"].".png" ?>' alt="Avatar">
                    </div>
                    <div class="user-info">
                        <span class="user-name"><?= AuthUser::Get()["firstName"] ?> <strong><?= AuthUser::Get()["lastName"] ?></strong></span>
                        <span class="user-role"><?= intval(AuthUser::Get()["role"])==0?"Administrator":"User"; ?></span>
                        <span class="user-status">
                            <i class="fa fa-envelope"></i>
                            <span><?= AuthUser::Get()["email"] ?></span>
                        </span>
                    </div>
                </div>
                <div class="sidebar-menu" runat="server" id="sidebarItems">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="<?= ROOT."home" ?>">Index</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-file"></i>
                                <span>Files</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="<?= ROOT."files/upload" ?>">Upload files</a>
                                    </li>
                                    <li>
                                        <a href="<?= ROOT."files/download" ?>">Download files</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Users</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="<?= ROOT."users/index/professor" ?>">Professors</a>
                                    </li>
                                    <li>
                                        <a href="<?= ROOT."users/index/student" ?>">Students</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-footer">
                <?php if(AuthUser::IsAdministrator()){ ?>
                    <?php $nbr = count(Model::Get("SELECT id FROM user WHERE activated = 0"));?>
                    <a href="<?= ROOT."users/customize" ?>" title="<?= "You have ".$nbr." user".(($nbr > 1)?"s":"")." to verify." ?>">
                        <i class="fa fa-bell"></i>
                        <?php ;echo $nbr > 0?'<span class="badge badge-pill badge-warning notification">'.$nbr.'</span>':'';?>
                    </a>
                <?php } ?>
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span class="badge-sonar"></span>
                </a>
                <a href="<?= ROOT."auths/logout" ?>">
                    <i class="fa fa-power-off"></i>
                </a>
            </div>
        </nav>
        <main class="page-content">
            <nav class="navbar navbar-dark bg-dark">
                <div class="btn btn-dark" id="toggle-sidebar"><i class="fas fa-times"></i></div>
                <div>
                    <a href="<?= ROOT."files/upload" ?>" class="btn btn-dark"><i class="fas fa-file-upload" title="Upload files"></i></a>
                    <a href="<?= ROOT."files/download" ?>" class="btn btn-dark float-right"><i class="fas fa-file-download" title="Download files"></i></a>
                </div>
            </nav>
            <?php
                echo $content_for_layout;
            ?>
        </main>
    </div>
</body>
</html>
