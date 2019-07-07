<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tea Break</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href=<?php echo base_url("apple-icon.png")?>>
    <link rel="shortcut icon" href=<?php echo base_url("assets/logo.ico")?>>

    <link rel="stylesheet" href=<?php echo base_url("assets/css/normalize.css")?>>

    <link rel="stylesheet" href=<?php echo base_url("assets/vendors/bootstrap-4.1.3-dist/css/bootstrap.css")?>>

    <link rel="stylesheet" href=<?php echo base_url("assets/css/font-awesome.min.css")?>>

    <link rel="stylesheet" href=<?php echo base_url("assets/css/themify-icons.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/flag-icon.min.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/teabreak.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/cs-skin-elastic.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/datatable/DataTables-1.10.18/css/jquery.dataTables.min.css") ?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/datatable/dataTables.min.css") ?>>
    <!-- bootstrap-daterangepicker -->
    <link rel="stylesheet" href=<?php echo base_url("assets/vendors/bootstrap-daterangepicker/daterangepicker.css")?> >
    <!-- bootstrap-datetimepicker -->
    <link rel="stylesheet" href=<?php echo base_url("assets/vendors/Date-Time-Picker-Bootstrap-4/build/css/bootstrap-datetimepicker.min.css")?>>
    <!-- <link rel="stylesheet" href=<echo base_url("assets/css/bootstrap-select.less")?>> -->
    <link rel="stylesheet" href=<?php echo base_url("assets/scss/style.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/lib/chosen/chosen.min.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/easy-autocomplete.min.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/easy-autocomplete.themes.css")?>>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src=<echo base_url("https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js")?>></script> -->
    
    <script src=<?php echo base_url("assets/js/jquery.min.js")?>></script>
    <script type="text/javascript">
        $(document).ready(function($){
            $('#'+location.pathname.split("/")[2]).addClass('active');
        });
    </script>
</head>
<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">Tea Break</a>
                <a class="navbar-brand hidden" href="./">T</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li id="dashboardsuperadmin">
                        <a href="<?=base_url('dashboardadmin');?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>

                    <h3 class="menu-title">PRODUKSI</h3><!-- /.menu-title -->
                    <li id="bahanbakumasuk">
                        <a href="<?=base_url('bahanbakumasuk');?>"> <i class="menu-icon ti-package"></i>Bahan Baku Masuk</a>
                    </li>
                    <li id="sistemproduksi">
                        <a href="<?=base_url('sistemproduksi');?>"> <i class="menu-icon ti-paint-bucket"></i>Sistem Produksi</a>
                    </li>
                </ul>
            </div>

        </nav>
    </aside>


    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa-tasks"></i></a>
                    <div class="header-left">
                        <h5 style="padding-top: 5px;">Selamat datang, <?=$this->session->userdata('nama');?>!</h5>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?=base_url('assets/images/admin.png');?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="<?=base_url('gantipassword');?>"><i class="fa fa-fw fa-cog"></i>&nbsp;Ganti Password</a>
                            <a class="nav-link" href="<?=base_url('logout');?>"><i class="fa fa-fw fa-power-off"></i>&nbsp;Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </header><!-- /header -->