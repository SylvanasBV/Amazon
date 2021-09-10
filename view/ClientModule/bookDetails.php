<?php
date_default_timezone_set("America/Bogota");
require_once('../business/ManageBook.php');
require_once('../business/ManageBooking.php');
require_once('../business/ManageAudit.php');
require_once('../business/ManagePresentation.php');
require_once('../business/ManageScienceArticle.php');
require_once('../business/Booking.php');
require_once('../business/Audit.php');
require_once('../persistence/util/Connection.php');
require_once('util.php');

if (isset($_POST['operation'])) {
    $cod = $_POST["mess"];
    $type = $_POST["type"];
    $con = new Connection();
    $connection = $con->conectBD();
    $fecha_ini = date('Y-m-d H:i:s');

    ManageAudit::setConnectionBD($connection);
    $audit= new Audit();
    $audit->setCod_user($_SESSION['cod_user']);
    $audit->setAudit_date($fecha_ini);
    $audit->setCod_affected($cod);
    switch ($type) {
        case 0:
            ManageBooking::setConnectionBD($connection);
            $audit->setTable_affected('book');
            if ($_POST['operation'] == 'Y') {
                $booking = new Booking();
                $booking->setCod_booking(0);
                $booking->setCod_document($cod);
                $booking->setType_document('book');
                $booking->setAvailable('Y');
                $booking->setCod_user($_SESSION['cod_user']);
                ManageBooking::create($booking);
                $audit->setAction('Insert');
                echo printMessage("Congratulations " . $_SESSION['name_user'], "Your book was booked successfully", "success");
            } else {
                $return = ManageBooking::consultByUser($cod, 'book', $_SESSION['cod_user']);
                $return->setAvailable('N');
                ManageBooking::modify($return);
                echo printMessage("Congratulations " . $_SESSION['name_user'], "Your book was returned successfully", "success");
                $audit->setAction('Update');
            }
            ManageAudit::create($audit);
            break;
        case 1:
            ManageBooking::setConnectionBD($connection);
            $audit->setTable_affected('presentation');
            if ($_POST['operation'] == 'Y') {
                $booking = new Booking();
                $booking->setCod_booking(0);
                $booking->setCod_document($cod);
                $booking->setType_document('presentation');
                $booking->setAvailable('Y');
                $booking->setCod_user($_SESSION['cod_user']);
                ManageBooking::create($booking);
                $audit->setAction('Insert');
                echo printMessage("Congratulations " . $_SESSION['name_user'], "Your paper was booked successfully", "success");
            } else {
                $return = ManageBooking::consultByUser($cod, 'presentation', $_SESSION['cod_user']);
                $return->setAvailable('N');
                ManageBooking::modify($return);
                $audit->setAction('Update');
                echo printMessage("Congratulations " . $_SESSION['name_user'], "Your paper was returned successfully", "success");
            }
            ManageAudit::create($audit);
            break;
        case 2:
            ManageBooking::setConnectionBD($connection);
            $audit->setTable_affected('sciencearticle');
            if ($_POST['operation'] == 'Y') {
                $booking = new Booking();
                $booking->setCod_booking(0);
                $booking->setCod_document($cod);
                $booking->setType_document('sciencearticle');
                $booking->setAvailable('Y');
                $booking->setCod_user($_SESSION['cod_user']);
                ManageBooking::create($booking);
                $audit->setAction('Insert');
                echo printMessage("Congratulations " . $_SESSION['name_user'], "Your article was booked successfully", "success");
            } else {
                $return = ManageBooking::consultByUser($cod, 'sciencearticle', $_SESSION['cod_user']);
                $return->setAvailable('N');
                ManageBooking::modify($return);
                $audit->setAction('Update');
                echo printMessage("Congratulations " . $_SESSION['name_user'], "Your article was returned successfully", "success");
            }
            ManageAudit::create($audit);
            break;
    }
}
if(isset($_POST['del'])){
    $cod = $_POST["mess"];
    $type = $_POST["type"];
    $con = new Connection();
    $connection = $con->conectBD();
    ManageBooking::setConnectionBD($connection);
    $fecha_ini = date('Y-m-d H:i:s');
    if($type==0){
        $type='book';
    }else if($type==1){
        $type='presentation';
    }else if ($type==2){
        $type='sciencearticle';
    }
    ManageAudit::setConnectionBD($connection);
    $audit= new Audit();
    $audit->setCod_user($_SESSION['cod_user']);
    $audit->setAudit_date($fecha_ini);
    $audit->setCod_affected($cod);
    $audit->setTable_affected($type);
    $audit->setAction('Delete');
    ManageAudit::create($audit);

    $reserves=ManageBooking::listByDoc($cod,$type);
    if(count($reserves)==0){
        switch($type){
            case 'book':
                ManageBook::setConnectionBD($connection);
                $book = ManageBook::consult($cod);
                $book->setAvailable('N');
                ManageBook::modify($book);
                echo printMessageWithRedirect("Congratulations " . $_SESSION['name_user'], "Your book was deleted successfully", "success","?menu=books");
                break;
            case 'presentation':
                ManagePresentation::setConnectionBD($connection);
                $book = ManagePresentation::consult($cod);
                $book->setAvailable('N');
                ManagePresentation::modify($book);
                echo printMessageWithRedirect("Congratulations " . $_SESSION['name_user'], "Your paper was deleted successfully", "success","?menu=books");
                break;
            case 'sciencearticle':
                ManageScienceArticle::setConnectionBD($connection);
                $book = ManageScienceArticle::consult($cod);
                $book->setAvailable('N');
                ManageScienceArticle::modify($book);
                echo printMessageWithRedirect("Congratulations " . $_SESSION['name_user'], "Your article was deleted successfully", "success","?menu=books");
                break;
        }
    }else{
        echo printMessage("Error!!", $_SESSION['name_user']. " you cannot delete this document, because it has active reservations", "error");
    }
}
if ($_POST["mess"]) {
    $cod = $_POST["mess"];
    $type = $_POST["type"];
    $con = new Connection();
    $connection = $con->conectBD();
    ManageBooking::setConnectionBD($connection);
    if ($type == 0) {
        ManageBook::setConnectionBD($connection);
        $book = ManageBook::consult($cod);

        if($book->getIdUser()==$_SESSION['cod_user']){
            $btnDelete = '<form id="f2" name="f2" method="post" action="?menu=details"><input type="hidden" name="mess" id="mess" value="' . $cod . '"><input type="hidden" name="type" id="type" value="' . $type . '"><input type="hidden" name="del" id="del"><a href="javascript:void(0)" class="btn btn-primary"  onclick="document.getElementById(' . "'f2'" . ').submit();">Delete Book</a></form>';
        }else{
            $btnDelete ='';
        }

        $reserves = ManageBooking::listByDoc($cod, 'book');
        $return = ManageBooking::consultByUser($cod, 'book', $_SESSION['cod_user']);
        if ($return->getCod_user() != '') {
            $msgAvai = 'Return now';
            $disp = $book->getQuantity() - count($reserves);
            $btnReserve = '<form id="f1" name="f1" method="post" action="?menu=details"><input type="hidden" name="operation" id="operation" value="N"><input type="hidden" name="mess" id="mess" value="' . $cod . '"><input type="hidden" name="type" id="type" value="' . $type . '"><a href="javascript:void(0)" class="btn btn-dark-gray"  onclick="document.getElementById(' . "'f1'" . ').submit();">Return now</a></form>';
        } else {
            if (count($reserves) < $book->getQuantity()) {
                $msgAvai = 'Available now';
                $disp = $book->getQuantity() - count($reserves);
                $btnReserve = '<form id="f1" name="f1" method="post" action="?menu=details"><input type="hidden" name="operation" id="operation" value="Y"><input type="hidden" name="mess" id="mess" value="' . $cod . '"><input type="hidden" name="type" id="type" value="' . $type . '"><a href="javascript:void(0)" class="btn btn-dark-gray"  onclick="document.getElementById(' . "'f1'" . ').submit();">Reserve now</a></form>';
            } else {
                $msgAvai = 'No copies available';
                $disp = $book->getQuantity() - count($reserves);
                $btnReserve = '';
            }
        }

        $name = $book->getTitle();
        $author = $book->getAuthors();
        $date = $book->getDatePublished();
        $isbn = $book->getIsbn();
        $publisher = $book->getEditorial();
        $pages = $book->getNumPages();
        $desciption = $book->getDescription();
        $cover = $book->getUrl();
        $lenght = "<p><strong>Lenght:</strong>$pages</p>";
        $isnn = "ISBN:";
        $icon = "yellow-icon";
    } elseif ($type == 1) {
        ManagePresentation::setConnectionBD($connection);
        $book = ManagePresentation::consult($cod);

        if($book->getIdUser()==$_SESSION['cod_user']){
            $btnDelete = '<form id="f2" name="f2" method="post" action="?menu=details"><input type="hidden" name="mess" id="mess" value="' . $cod . '"><input type="hidden" name="type" id="type" value="' . $type . '"><input type="hidden" name="del" id="del"><a href="javascript:void(0)" class="btn btn-primary"  onclick="document.getElementById(' . "'f2'" . ').submit();">Delete Paper</a></form>';
        }else{
            $btnDelete ='';
        }

        $reserves = ManageBooking::listByDoc($cod, 'presentation');
        $return = ManageBooking::consultByUser($cod, 'presentation', $_SESSION['cod_user']);
        if ($return->getCod_user() != '') {
            $msgAvai = 'Return now';
            $disp = $book->getQuantity() - count($reserves);
            $btnReserve = '<form id="f1" name="f1" method="post" action="?menu=details"><input type="hidden" name="operation" id="operation" value="N"><input type="hidden" name="mess" id="mess" value="' . $cod . '"><input type="hidden" name="type" id="type" value="' . $type . '"><a href="javascript:void(0)" class="btn btn-dark-gray"  onclick="document.getElementById(' . "'f1'" . ').submit();">Return now</a></form>';
        } else {
            if (count($reserves) < $book->getQuantity()) {
                $msgAvai = 'Available now';
                $disp = $book->getQuantity() - count($reserves);
                $btnReserve = '<form id="f1" name="f1" method="post" action="?menu=details"><input type="hidden" name="operation" id="operation" value="Y"><input type="hidden" name="mess" id="mess" value="' . $cod . '"><input type="hidden" name="type" id="type" value="' . $type . '"><a href="javascript:void(0)" class="btn btn-dark-gray"  onclick="document.getElementById(' . "'f1'" . ').submit();">Reserve now</a></form>';
            } else {
                $msgAvai = 'No copies available';
                $disp = $book->getQuantity() - count($reserves);
                $btnReserve = '';
            }
        }

        $name = $book->getTitle();
        $author = $book->getAuthors();
        $isbn = $book->getIsbn();
        $publisher = $book->getEditorial();
        $date = $book->getDatePublished();
        $congress = $book->getCongressName();
        $desciption = $book->getDescription();
        $cover = $book->getUrl();
        $lenght = "<p><strong>Congress Name:</strong>$congress</p>";
        $isnn = "ISBN:";
        $icon = "red-icon";
    } elseif ($type == 2) {
        ManageScienceArticle::setConnectionBD($connection);
        $book = ManageScienceArticle::consult($cod);

        if($book->getIdUser()==$_SESSION['cod_user']){
            $btnDelete = '<form id="f2" name="f2" method="post" action="?menu=details"><input type="hidden" name="mess" id="mess" value="' . $cod . '"><input type="hidden" name="type" id="type" value="' . $type . '"><input type="hidden" name="del" id="del"><a href="javascript:void(0)" class="btn btn-primary"  onclick="document.getElementById(' . "'f2'" . ').submit();">Delete Article</a></form>';
        }else{
            $btnDelete ='';
        }

        $reserves = ManageBooking::listByDoc($cod, 'sciencearticle');
        $return = ManageBooking::consultByUser($cod, 'sciencearticle', $_SESSION['cod_user']);
        if ($return->getCod_user() != '') {
            $msgAvai = 'Return now';
            $disp = $book->getQuantity() - count($reserves);
            $btnReserve = '<form id="f1" name="f1" method="post" action="?menu=details"><input type="hidden" name="operation" id="operation" value="N"><input type="hidden" name="mess" id="mess" value="' . $cod . '"><input type="hidden" name="type" id="type" value="' . $type . '"><a href="javascript:void(0)" class="btn btn-dark-gray"  onclick="document.getElementById(' . "'f1'" . ').submit();">Return now</a></form>';
        } else {
            if (count($reserves) < $book->getQuantity()) {
                $msgAvai = 'Available now';
                $disp = $book->getQuantity() - count($reserves);
                $btnReserve = '<form id="f1" name="f1" method="post" action="?menu=details"><input type="hidden" name="operation" id="operation" value="Y"><input type="hidden" name="mess" id="mess" value="' . $cod . '"><input type="hidden" name="type" id="type" value="' . $type . '"><a href="javascript:void(0)" class="btn btn-dark-gray"  onclick="document.getElementById(' . "'f1'" . ').submit();">Reserve now</a></form>';
            } else {
                $msgAvai = 'No copies available';
                $disp = $book->getQuantity() - count($reserves);
                $btnReserve = '';
            }
        }

        $name = $book->getTitle();
        $author = $book->getAuthors();
        $date = $book->getDatePublished();
        $isbn = $book->getSSN();
        $publisher = $book->getEditorial();
        $desciption = $book->getDescription();
        $cover = $book->getUrl();

        $icon = "light-green-icon";
        $lenght = "";
        $isnn = "SNN:";
    }
} else {
    header('Location: user.php?menu=books');
}

?>
<style>
    .navbar-default .navbar-nav>.books>a,
    .navbar-default .navbar-nav>.books>a:hover,
    .navbar-default .navbar-nav>.books>a:focus {
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

    .col-md-3 {
        width: 22%;
    }

    .select-styled {
        display: none;
    }
</style>
<!-- Start: Page Banner -->
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>Books & Media Listing</h2>
            <span class="underline center"></span>
            <p class="lead">Books, lectures or scientific articles, choose whichever you prefer!</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="?menu=home">Home</a></li>
                <li><a href="?menu=books">Books & Media</a></li>

                <li><?php echo $name; ?></li>
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
                    <div class="booksmedia-detail-box">
                        <div class="detailed-box">
                            <div class="col-xs-12 col-sm-5 col-md-3">
                                <div class="post-thumbnail">
                                    <div class="book-list-icon <?php echo $icon; ?>"></div>
                                    <img src="<?php echo $cover; ?>" alt="Book Image">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-6">

                                <div class="post-center-content">
                                    <h2><?php echo $name; ?></h2>
                                    <p><strong>Author: </strong><?php echo $author; ?> </p>
                                    <p><strong>Date Published: </strong><?php echo $date; ?> </p>
                                    <p><strong> <?php echo $isnn; ?></strong> <?php echo $isbn; ?></p>
                                    <p><strong>Publisher: </strong><?php echo $publisher; ?></p>
                                    <?php echo $lenght; ?>
                                    <div class="actions">
                                        <ul>
                                            <li>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 ">
                                <div class="post-right-content">
                                    <h4><?php echo $msgAvai ?></h4>
                                    <p><strong>Copies availables:</strong> <?php echo $disp; ?></p>
                                    <p><strong>On the shelves now at:</strong> Amazonia en Linea</p>
                                    <?php 
                                        echo $btnReserve;
                                        echo $btnDelete;
                                    ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <p><strong>Summary: </strong><?php echo $desciption; ?> </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- End: Products Section -->

<!-- Start: Social Network -->
<section class="social-network section-padding">
</section>