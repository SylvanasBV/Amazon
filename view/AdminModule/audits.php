<?php
require_once('../business/ManageBook.php');
require_once('../business/ManagePresentation.php');
require_once('../business/ManageScienceArticle.php');
require_once('../business/ManageAudit.php');
require_once('../business/ManageAdmin.php');
require_once('../business/ManageUser.php');
require_once('../business/User.php');

require_once('../persistence/util/Connection.php');


$con = new Connection();
$connection = $con->conectBD();

ManageBook::setConnectionBD($connection);
ManagePresentation::setConnectionBD($connection);
ManageScienceArticle::setConnectionBD($connection);
ManageAudit::setConnectionBD($connection);

$books = ManageAudit::listAll();

$table = '<table class="table text-center" id="myTable" style="text-align-last: center;"><thead><th>User</th><th>Date</th><th>Action</th><th>Table Affected</th><th>Affected</th></thead><tbody>';
foreach ($books as $book) {
    if($book->getCod_user() >100000)
    {
        ManageAdmin::setConnectionBD($connection);
        $us=ManageAdmin::consult($book->getCod_user())->getName();
    }
    else{
        ManageUser::setConnectionBD($connection);
        $us=ManageUser::consult($book->getCod_user())->getName();
    }
    
    switch($book->getTable_affected()){
        case 'book':
            $type='Book';
            ManageBook::setConnectionBD($connection);
            $nom=ManageBook::consult($book->getCod_affected())->getTitle();
            break;
        case 'presentation':
            $type='Presentation';
            ManagePresentation::setConnectionBD($connection);
            $nom=ManagePresentation::consult($book->getCod_affected())->getTitle();
            break;
        case 'sciencearticle':
            $type='Science Article';
            ManageScienceArticle::setConnectionBD($connection);
            $nom=ManageScienceArticle::consult($book->getCod_affected())->getTitle();
            break;
    }

    $table .= '<tr><td>' . $us . '</td><td>' . $book->getAudit_date() . '</td><td>' . $book->getAction() . '</td><td>'. $type .'</td><td>' . $nom . '</td></tr>';
}

$table .= '</tbody></table>';


?>
<style>
    .navbar-default .navbar-nav>.cruds>a,
    .navbar-default .navbar-nav>.cruds>a:hover,
    .navbar-default .navbar-nav>.cruds>a:focus {
        color: #ff7236;
        background-color: transparent;
    }

    .detailed-box .post-thumbnail {
        display: inline-block;
        margin: 0px -15px 0px -15px;
        position: relative;
        padding: 0px;
        vertical-align: top;
    }

    .dataTables_wrapper .dataTables_filter {
        float: left;
        text-align: left;
    }

    .button {
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
    }

    .btn1 {
        background-color: white;
        color: black;
        border: 2px solid #1bcc00;
    }

    .btn1:hover {
        background-color: #1bcc00;
        color: white;
    }

    .btn2 {
        background-color: white;
        color: black;
        border: 2px solid #ff4040;
    }

    .btn2:hover {
        background-color: #ff4040;
        color: white;
    }
</style>
<!-- Start: Page Banner -->
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>Audit</h2>
            <span class="underline center"></span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="?menu=home">Home</a></li>
                <li><a href="#">Cruds</a></li>
                <li>Audit</li>
            </ul>
        </div>
    </div>
</section>
<!-- End: Page Banner -->

<!-- Start: Products Section -->
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="booksmedia-detail-main">
                <div class="container">
                <br><br>
                    <?php
                    echo $table; ?>
                </div>
            </div>
        </main>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            language: {
                search: "<i class='fa fa-search'></i>",
                searchPlaceholder: "Search"

            }
        });
    });

    function setColor(b) {
        var bu = document.getElementById(b);
        if (bu.className == "btn1") {
            bu.className = "btn2";
            bu.innerHTML = "<i class=\"fa fa-times\" style=\"color:red;\"></i>";
        } else if (bu.className == "btn2") {
            bu.className = "btn1";
            bu.innerHTML = "<i class=\"fa fa-check\" style=\"color:green;\"></i>";
        }

    }
</script>
<!-- End: Products Section -->

<!-- Start: Social Network -->
<section class="social-network section-padding">
</section>