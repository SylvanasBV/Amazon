<?php
if (isset($_POST['upload'])) {
    $document = $_POST['dc'];
    require_once('../persistence/util/Connection.php');
    require_once('util.php');

    $con = new Connection;
    $connection = $con->conectBD();
    $url = '';
    if ($_FILES["logo"]["tmp_name"]) {
        $url = saveImage($_POST["title"], $_FILES["logo"]["tmp_name"]);
    }
    switch ($document) {
        case 'book':
            require_once('../business/ManageBook.php');
            require_once('../business/Book.php');
            ManageBook::setConnectionBD($connection);
            $book = new Book();
            $book->setId(0);
            $book->setTitle($_POST["title"]);
            $book->setIsbn($_POST["isbn"]);
            $book->setDatePublished($_POST["date"]);
            $book->setEditorial($_POST["editorial"]);
            $book->setAvailable('N');
            $book->setUrl($url);
            $book->setAuthors($_POST["authors"]);
            $book->setDescription($_POST["description"]);
            $book->setIdUser(1);
            $book->setNumPages($_POST["numPages"]);
            $book->setQuantity($_POST["quantity"]);
            ManageBook::create($book);
            echo printMessage("Congratulations!!", "Your book was uploaded to the platform, now it is waiting for an administrator to validate it", "success");
            break;
        case 'sa':
            require_once('../business/ManageScienceArticle.php');
            require_once('../business/ScienceArticle.php');
            ManageScienceArticle::setConnectionBD($connection);
            $scienceArticle = new scienceArticle();
            $scienceArticle->setId(0);
            $scienceArticle->setTitle($_POST["title"]);
            $scienceArticle->setSSN($_POST["ssn"]);
            $scienceArticle->setDatePublished($_POST["date"]);
            $scienceArticle->setEditorial($_POST["editorial"]);
            $scienceArticle->setAvailable('N');
            $scienceArticle->setUrl($url);
            $scienceArticle->setAuthors($_POST["authors"]);
            $scienceArticle->setDescription($_POST["description"]);
            $scienceArticle->setIdUser(1);
            $scienceArticle->setQuantity($_POST['quantity']);

            ManageScienceArticle::create($scienceArticle);
            echo printMessage("Congratulations!!", "Your article was uploaded to the platform, now it is waiting for an administrator to validate it", "success");
            break;
        case 'presentation':
            require_once('../business/ManagePresentation.php');
            require_once('../business/Presentation.php');
            ManagePresentation::setConnectionBD($connection);
            $presentation = new Presentation();
            $presentation->setId(0);
            $presentation->setTitle($_POST["title"]);
            $presentation->setIsbn($_POST["isbn"]);
            $presentation->setDatePublished($_POST["date"]);
            $presentation->setEditorial($_POST["editorial"]);
            $presentation->setAvailable('N');
            $presentation->setUrl($url);
            $presentation->setAuthors($_POST["authors"]);
            $presentation->setDescription($_POST["description"]);
            $presentation->setIdUser(1);
            $presentation->setCongressName($_POST["congressName"]);
            $presentation->setQuantity($_POST["quantity"]);

            ManagePresentation::create($presentation);
            echo printMessage("Congratulations!!", "Your presentation was uploaded to the platform, now it is waiting for an administrator to validate it", "success");
            break;
    }
}
?>
<style>
    .navbar-default .navbar-nav>.books>a,
    .navbar-default .navbar-nav>.books>a:hover,
    .navbar-default .navbar-nav>.books>a:focus {
        color: #ff7236;
        background-color: transparent;
    }

    .select-styled {
        display: none;
    }

    .company-info .company-detail input[type="text"],
    .company-info .company-detail input[type="email"],
    .company-info .company-detail input[type="url"],
    .company-info .company-detail input[type="password"],
    .company-info .company-detail input[type="search"],
    .company-info .company-detail input[type="number"],
    .company-info .company-detail input[type="tel"],
    .company-info .company-detail input[type="range"],
    .company-info .company-detail input[type="date"],
    .company-info .company-detail input[type="month"],
    .company-info .company-detail input[type="week"],
    .company-info .company-detail input[type="time"],
    .company-info .company-detail input[type="datetime"],
    .company-info .company-detail input[type="datetime-local"],
    .company-info .company-detail input[type="color"] {
        background-color: #fff;
        border-color: #F4F4F4;
    }
</style>
<script>
    window.onload = function() {
        $(".dc").select2();
        dropify = $('.dropify').dropify();
    };

    function changer(val) {
        var div = ''
        if (val == 'book') {
            div = '<label style="color:grey;">' +
                'Number of pages' +
                '</label>' +
                '<input type="text" id="numPages" name="numPages" class="input-text" required>' +
                '<label style="color:grey;">' +
                'ISBN' +
                '</label>' +
                '<input type="text" id="isbn" name="isbn" class="input-text" required>' +
                '</p>';
        } else if (val == 'presentation') {
            div = '<label style="color:grey;">' +
                'Congress Name' +
                '</label>' +
                '<input type="text" id="congressName" name="congressName" class="input-text" required>' +
                '<label style="color:grey;">' +
                'ISBN' +
                '</label>' +
                '<input type="text" id="isbn" name="isbn" class="input-text" required>' +
                '</p>';
        } else if (val == 'sa') {
            div = '<label style="color:grey;">' +
                'SSN' +
                '</label>' +
                '<input type="text" id="ssn" name="ssn" class="input-text" required>';
        }
        $("#changer").html(div);
    }
</script>
<!-- Start: Page Banner -->
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>New Document</h2>
            <span class="underline center"></span>
            <p class="lead"></p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="?menu=home">Home</a></li>
                <li><a href="?menu=books">Books & Media</a></li>
                <li>Register New Document</li>
            </ul>
        </div>
    </div>
</section>
<!-- End: Page Banner -->
<!-- Start: Cart Section -->
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="signin-main">
                <div class="container">
                    <div class="woocommerce">
                        <div class="woocommerce-login">
                            <div class="company-info signin-register">
                                <div class="col-md-12 new-user" style="border: 20px solid #f4f4f4;">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="text-center" style="margin: 80px -40px 80px 40px;">
                                                <div class="company-detail new-account bg-light ">
                                                    <div class="new-user-head">
                                                        <h2>Register New Document</h2>
                                                        <br>
                                                    </div>
                                                    <form class="login" method="post" enctype="multipart/form-data">
                                                        <label style="color:grey;">
                                                            Title
                                                        </label>
                                                        <input type="text" id="title" name="title" class="input-text" required>
                                                        <label style="color:grey;">
                                                            Editorial
                                                        </label>
                                                        <input type="text" id="editorial" name="editorial" class="input-text" required>
                                                        <label style="color:grey;">
                                                            Authors
                                                        </label>
                                                        <input type="text" id="authors" name="authors" class="input-text" required>
                                                        <label style="color:grey;">
                                                            Quantity
                                                        </label>
                                                        <input type="number" id="quantity" name="quantity" class="input-text" required min="1" max="100">

                                                        <label style="color:grey;">
                                                            Date published
                                                        </label>
                                                        <input type="date" id="date" name="date" style="background-color: #fff; border-color: #F4F4F4;">
                                                        <label style="color:grey;" style="text-align:left;">Description*</label>
                                                        <textarea style="width:100%;" rows="5" name="description" id="description" required></textarea>
                                                        <label style="color:grey;">Document Type</label>
                                                        <select id="dc" name="dc" class="dc" style="width:100%;" required onchange="changer(this.value)">
                                                            <option value="">Choose one</option>
                                                            <option value="book">Book</option>
                                                            <option value="sa">Science Article</option>
                                                            <option value="presentation">Paper</option>
                                                        </select><br><br>
                                                        <label style="color:grey;" style="margin-top:10%;">Photo</label>
                                                        <input type="file" class="form-control-file dropify" name="logo" id="logo" accept=".png,.jpeg,.jpg" data-allowed-file-extensions="png jpeg jpg" required>
                                                        <div id="changer">

                                                        </div>
                                                        <div class="clear"></div>
                                                        <br>
                                                        <button type="submit" name="upload" id="upload" class="button btn btn-default">Upload <i class="fa fa-upload"></i></button>
                                                        <div class="clear"></div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- End: Cart Section -->

<!-- Start: Social Network -->
<section class="social-network section-padding">
</section>
<!-- End: Social Network -->