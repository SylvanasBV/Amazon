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
</style>
<?php
require_once('../persistence/util/Connection.php');
require_once('util.php');
require_once('../business/ManageBook.php');
require_once('../business/Book.php');
require_once('../business/ManagePresentation.php');
require_once('../business/Presentation.php');
require_once('../business/ManageScienceArticle.php');
require_once('../business/ScienceArticle.php');
require_once('../business/ManageAudit.php');
require_once('../business/Audit.php');


$con = new Connection;
$connection = $con->conectBD();
if (isset($_POST['upload'])) {
    $cod = $_POST['cod'];
    $document = $_POST['dc'];
    $url = '';
    if ($_FILES["logo"]["tmp_name"]) {
        $url = saveImage($_POST["title"], $_FILES["logo"]["tmp_name"]);
    } else {
        $url = $_POST['url'];
    }
    $fecha_ini = date('Y-m-d H:i:s');
    ManageAudit::setConnectionBD($connection);
    $audit= new Audit();
    $audit->setCod_user($_SESSION['cod_user']);
    $audit->setAudit_date($fecha_ini);
    $audit->setCod_affected($cod);
    $audit->setAction('Update');

    switch ($document) {
        case 0:
            ManageBook::setConnectionBD($connection);
            $book = new Book();
            $book->setId($cod);
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
            ManageBook::modify($book);

            $audit->setTable_affected('book');
            ManageAudit::create($audit);

            echo printMessageWithRedirect("Congratulations!!", "Your book was uploaded to the platform, now it is waiting for an administrator to validate it", "success", "user.php?menu=myBooks");
            break;
        case 2:
            ManageScienceArticle::setConnectionBD($connection);
            $scienceArticle = new scienceArticle();
            $scienceArticle->setId($cod);
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
            ManageScienceArticle::modify($scienceArticle);

            $audit->setTable_affected('sciencearticle');
            ManageAudit::create($audit);

            echo printMessageWithRedirect("Congratulations!!", "Your article was uploaded to the platform, now it is waiting for an administrator to validate it", "success", "user.php?menu=myBooks");
            break;
        case 1:
            ManagePresentation::setConnectionBD($connection);
            $presentation = new Presentation();
            $presentation->setId($cod);
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
            ManagePresentation::modify($presentation);

            $audit->setTable_affected('presentation');
            ManageAudit::create($audit);

            echo printMessageWithRedirect("Congratulations!!", "Your presentation was uploaded to the platform, now it is waiting for an administrator to validate it", "success", "user.php?menu=myBooks");
            break;
    }
}
if (isset($_POST['mess'])) {
    $cod = $_POST['mess'];
    $type = $_POST['type'];
    $document = "";
    if ($type == 0) {

        ManageBook::setConnectionBD($connection);
        $document = ManageBook::consult($cod);
    }
    if ($type == 1) {

        ManagePresentation::setConnectionBD($connection);
        $document = ManagePresentation::consult($cod);
    }
    if ($type == 2) {

        ManageScienceArticle::setConnectionBD($connection);
        $document = ManageScienceArticle::consult($cod);
    }

?>

    <script>
        window.onload = function() {
            dropify = $('.dropify').dropify();
        };
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
                    <li><a href="?menu=books">Documents & Media</a></li>
                    <li>Edit: <?php echo $document->getTitle(); ?></li>
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
                                                            <h2>Edit Document</h2>
                                                            <br>
                                                        </div>
                                                        <form class="login" method="post" enctype="multipart/form-data">
                                                            <label style="color:grey;">
                                                                Title
                                                            </label>
                                                            <input type="text" id="title" name="title" class="input-text" value="<?php echo strtotitle($document->getTitle()); ?>" required>
                                                            <label style="color:grey;">
                                                                Editorial
                                                            </label>
                                                            <input type="hidden" name="dc" value="<?php echo $type; ?>" />;
                                                            <input type="hidden" name="cod" value="<?php echo $cod; ?>" />;
                                                            <input type="hidden" name="url" value="<?php echo $document->getUrl(); ?>" />;

                                                            <input type="text" id="editorial" name="editorial" class="input-text" value="<?php echo strtotitle($document->getEditorial()); ?>" required>
                                                            <label style="color:grey;">
                                                                Authors
                                                            </label>
                                                            <input type="text" id="authors" name="authors" class="input-text" value="<?php echo strtotitle($document->getAuthors()); ?>" required>

                                                            <label style="color:grey;">
                                                                Date published
                                                            </label>
                                                            <input type="date" id="date" name="date" style="background-color: #fff; border-color: #F4F4F4;" value="<?php echo $document->getDatePublished(); ?>">
                                                            <label style="color:grey;" style="text-align:left;">Description*</label>

                                                            <textarea style="width:100%;" rows="5" name="description" id="description" required><?php $des = str_replace("\\r\\n", " ", $document->getDescription());
                                                                                                                                                echo $des; ?></textarea>
                                                            <label style="color:grey;">
                                                                Quantity
                                                            </label>
                                                            <input type="number" id="quantity" style="background-color: #fff;  color: #707070;  border: 3px solid #f4f4f4;" name="quantity" class="input-number" value="<?php echo $document->getQuantity(); ?>" maxlength="3" required>

                                                            <label style="color:grey;" style="margin-top:10%;">Photo</label>
                                                            <input type="file" class="form-control-file dropify" name="logo" id="logo" accept=".png,.jpeg,.jpg" data-allowed-file-extensions="png jpeg jpg" data-default-file="<?php echo $document->getUrl(); ?>" value="<?php echo $document->getUrl(); ?>">

                                                            <?php
                                                            if ($type == 0) {
                                                                echo '<label style="color:grey;">
                                                                          Number of pages
                                                                      </label>
                                                                      <input type="text" id="numPages" name="numPages" class="input-text" value="' . $document->getNumPages() . '" required>
                                                                          <label style="color:grey;">ISBN
                                                                      </label>
                                                                      <input type="text" id="isbn" name="isbn" class="input-text" value="' . $document->getIsbn() . '" required>
                                                                      </p>';
                                                            }
                                                            if ($type == 1) {
                                                                echo '  <label style="color:grey;">
                                                                            Congress Name
                                                                        </label>
                                                                        <input type="text" id="congressName" name="congressName" class="input-text"  value="' . $document->getCongressName() . '" required>
                                                                            <label style="color:grey;">
                                                                                ISBN
                                                                            </label>
                                                                        <input type="text" id="isbn" name="isbn" class="input-text" value="' . $document->getIsbn() . '"  required>
                                                                        </p>';
                                                            }
                                                            if ($type == 2) {
                                                                echo '<label style="color:grey;">
                                                                          SSN
                                                                      </label>
                                                                      <input type="text" id="ssn" name="ssn" class="input-text"  value="' . $document->getSSN() . '" required>';
                                                            }
                                                            ?>
                                                            <div class="clear"></div>
                                                            <br>
                                                            <button type="submit" name="upload" id="upload" class="button btn btn-default">Save Changes <i class="fa fa-save"></i></button>
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
<?php } ?>