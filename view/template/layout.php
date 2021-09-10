<?php
session_start();

include_once('../persistence/util/Connection.php');
if (isset($_SESSION['redirect'])) {
    header('Location: '.$_SESSION['redirect']);
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">

    <!-- Title -->
    <title>..:: AMAZONÍA EN LINEA ::..</title>

    <!-- Favicon -->
    <link href="images/favicon.ico" rel="icon" type="image/x-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7CLato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- pagination -->
    <link type="text/css" rel="stylesheet" href="simplePagination.css"/>

    <!-- Stylesheet -->
    <link href="style.css" rel="stylesheet" type="text/css" />
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="dropify/dropify.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="dropify/dropify.min.css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
</head>

<body>

    <!-- Start: Header Section -->
    <header id="header-v1" class="navbar-wrapper">
        <?php
        require_once('header.php');
        ?>

    </header>
    <style>
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #1cc88a!important;
            color: #fff;
        }
        
    </style>
    <!-- End: Header Section -->

    <!-- Start: Slider Section -->
    <div id="panel">
        <div>

            <?php
            require_once('routing.php');
            ?>

        </div>
        <!-- Start: Footer -->
        <footer class="site-footer">
            <?php
            require_once('footer.php');
            ?>

        </footer>
        <!-- End: Footer -->
    </div>


    <!-- Facts Counter -->
    <script type="text/javascript" src="js/facts.counter.min.js"></script>

    <!-- MixItUp - Category Filter -->
    <script type="text/javascript" src="js/mixitup.min.js"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- Harvey - State manager for media queries -->
    <script type="text/javascript" src="js/harvey.min.js"></script>

    <!-- Accordion -->
    <script type="text/javascript" src="js/accordion.min.js"></script>

    <!-- Owl Carousel -->
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>

    <!-- Custom Scripts -->
    <script type="text/javascript" src="js/main.js"></script>
  
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <style>
        .swal2-modal .swal2-styled {
            border-left-color: orange!important;
            border-right-color: orange!important;
            background-color: orange!important;
        }
        .swal2-styled:hover {
            border-left-color: #FF8000!important;
            border-right-color: #FF8000!important;
            background-color: #FF8000!important;
        }
    </style>
    
</body>


</html>