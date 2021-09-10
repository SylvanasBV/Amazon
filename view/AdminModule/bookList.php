<?php

require_once('../business/ManageBook.php');
require_once('../business/ManagePresentation.php');
require_once('../business/ManageScienceArticle.php');
require_once('../persistence/util/Connection.php');
require_once('util.php');

$con = new Connection();
$connection = $con->conectBD();
$books = array();
$papers = array();
$articles = array();
if (isset($_POST['t'])) {
    $type = $_POST['t'];
    $key = $_POST['keywords'];
    if (isset($key)) {
        if (strlen($key) > 0) {
            $key = str_replace("'", "", $key);
            switch ($type) {
                case 'book':
                    ManageBook::setConnectionBD($connection);
                    $books = ManageBook::listByQuery($key);
                    break;
                case 'presentation':
                    ManagePresentation::setConnectionBD($connection);
                    $papers = ManagePresentation::listByQuery($key);
                    break;
                case 'sa':
                    ManageScienceArticle::setConnectionBD($connection);
                    $articles = ManageScienceArticle::listByQuery($key);
                    break;
                default:
                    ManageBook::setConnectionBD($connection);
                    $books = ManageBook::listByQuery($key);
                    ManagePresentation::setConnectionBD($connection);
                    $papers = ManagePresentation::listByQuery($key);
                    ManageScienceArticle::setConnectionBD($connection);
                    $articles = ManageScienceArticle::listByQuery($key);
                    break;
            }
        } else {
            switch ($type) {
                case 'book':
                    ManageBook::setConnectionBD($connection);
                    $books = ManageBook::listAll();
                    break;
                case 'presentation':
                    ManagePresentation::setConnectionBD($connection);
                    $papers = ManagePresentation::listAll();
                    break;
                case 'sa':
                    ManageScienceArticle::setConnectionBD($connection);
                    $articles = ManageScienceArticle::listAll();
                    break;
                default:
                    ManageBook::setConnectionBD($connection);
                    $books = ManageBook::listAll();

                    ManagePresentation::setConnectionBD($connection);
                    $papers = ManagePresentation::listAll();

                    ManageScienceArticle::setConnectionBD($connection);
                    $articles = ManageScienceArticle::listAll();
                    break;
            }
        }
    }
} else {
    ManageBook::setConnectionBD($connection);
    $books = ManageBook::listAll();

    ManagePresentation::setConnectionBD($connection);
    $papers = ManagePresentation::listAll();

    ManageScienceArticle::setConnectionBD($connection);
    $articles = ManageScienceArticle::listAll();
}
$results = count($books) + count($papers) + count($articles);


?>
<style>
    .navbar-default .navbar-nav>.books>a,
    .navbar-default .navbar-nav>.books>a:hover,
    .navbar-default .navbar-nav>.books>a:focus {
        color: #ff7236;
        background-color: transparent;
    }

    .pagination {
        margin: 20px 0;
        overflow: hidden;
        position: relative;
    }

    .pagination li {
        float: left;
    }

    .pagination ul {
        float: left;
        left: 50%;
        position: relative;
    }

    .pagination ul>li {
        left: -50%;
        position: relative;
    }

    .light-theme .current {
        background: #ff7236;
        color: #FFF;
        border-color: #ff7236;
    }

    .light-theme a,
    .light-theme span {
        float: left;
        color: #666;
        font-size: 20px;
        line-height: 34px;
        font-weight: bolder;
        text-align: center;
    }

    .booksmedia-fullwidth ul li {
        border: 5px solid #f3f3f3;
        display: inline-block;
        margin: 0 0px 30px 26px;
        position: relative;
        vertical-align: top;
        width: 22.5%;
    }

    .booksmedia-fullwidth img {
        width: 100%;
        height: 350px;
    }

    .error-info {
        padding: 23.5% 30px !important;
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
                <li>Books & Media</li>
            </ul>
        </div>
    </div>
</section>
<!-- End: Page Banner -->

<!-- Start: Products Section -->
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="books-full-width">
                <div class="container">
                    <!-- Start: Search Section -->
                    <section class="search-filters">
                        <div class="filter-box">
                            <h3>What are you looking for at the library?</h3>
                            <form action="?menu=books" method="post">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Search by Keyword" id="keywords" name="keywords" type="text">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <select name="t" id="t" class="form-control">
                                            <option>Search the Catalog</option>
                                            <option value="book">Books</option>
                                            <option value="presentation">Lectures</option>
                                            <option value="sa">Scientific Articles</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" type="submit" value="Search">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clear"></div>
                    </section>
                    <!-- End: Search Section -->
                    <?php
                    if ($results == 0) {
                    ?>
                        <div class="error-view" style="margin-top:-15%;">
                            <div class="company-info">
                                <div class="col-md-5 col-md-offset-1 border-dark-left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="error-box bg-dark margin-left text-center">
                                                <img src="images/error-img.png" alt="Error Image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 border-dark new-user">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="error-info bg-light margin-right">
                                                <br><br><br><br>
                                                <h2>OOPS <small>No Results Found!</small></h2>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="pagination">
                            <div id="page-nav" class="page-nav"></div>
                        </div>
                        <div class="booksmedia-fullwidth">
                            <ul>
                                <?php
                                if (count($books) == 0) {
                                } else {
                                    $no = 0;
                                    foreach ($books as $b) {
                                        if ($b->getAvailable() == "Y") {
                                            echo '<li class="paginate">
                                                    <div class="book-list-icon yellow-icon"></div>
                                                    <figure>
                                                    <form id="formB' . $no . '" target="_blank" action="?menu=details" method="post">
                                                        <a href="javascript:;" onclick="document.getElementById(' . "'formB$no'" . ').submit();">
                                                        <img src="' . $b->getUrl() . '" alt="Book"></a>
                                                        <input type="hidden" name="mess" value="' . $b->getId() . '"/>
                                                        <input type="hidden" name="type" value="0"/>
                                                    </form>
                                                        <figcaption>
                                                            <header>
                                                                <h4>
                                                                <form id="form1B' . $no . '" target="_blank" action="?menu=details" method="post">
                                                                    <a href="javascript:;" onclick="document.getElementById(' . "'form1B$no'" . ').submit();">
                                                                    ' . $b->getTitle() . '</a>
                                                                    <input type="hidden" name="mess" value="' . $b->getId() . '"/>
                                                                    <input type="hidden" name="type" value="0"/>
                                                                </form>
                                                                </h4>
                                                                <p><strong>Author:</strong> ' . strtotitle($b->getAuthors()) . '</p>
                                                                <p><strong>ISBN:</strong>' . $b->getISBN() . '</p>
                                                            </header>
                                                            <p>' . strtotitle($b->getDescription()) . '</p>
                                                            
                                                        </figcaption>
                                                    </figure>
                                                </li>';
                                            $no += 1;
                                        }
                                    }
                                }
                                if (count($papers) == 0) {
                                } else {
                                    $no = 0;
                                    foreach ($papers as $b) {
                                        if ($b->getAvailable() == "Y") {
                                            echo '<li class="paginate">
                                                    <div class="book-list-icon red-icon"></div>
                                                    <figure>
                                                    <form id="formP' . $no . '" target="_blank" action="?menu=details" method="post">
                                                        <a href="javascript:;" onclick="document.getElementById(' . "'formP$no'" . ').submit();">
                                                        <img src="' . $b->getUrl() . '" alt="Book"></a>
                                                        <input type="hidden" name="mess" value="' . $b->getId() . '"/>
                                                        <input type="hidden" name="type" value="1"/>
                                                    </form>
                                                        <figcaption>
                                                            <header>
                                                                <h4>
                                                                <form id="formP1' . $no . '" target="_blank" action="?menu=details" method="post">
                                                                    <a href="javascript:;" onclick="document.getElementById(' . "'formP1$no'" . ').submit();">
                                                                    ' . $b->getTitle() . '</a>
                                                                    <input type="hidden" name="mess" value="' . $b->getId() . '"/>
                                                                    <input type="hidden" name="type" value="1"/>
                                                                </form>
                                                                </h4>
                                                                <p><strong>Author:</strong> ' . strtotitle($b->getAuthors()) . '</p>
                                                                <p><strong>ISBN:</strong>' . $b->getISBN() . '</p>
                                                            </header>
                                                            <p>' . strtotitle($b->getDescription()) . '</p>
                                                            
                                                        </figcaption>
                                                    </figure>
                                                </li>';
                                            $no += 1;
                                        }
                                    }
                                }
                                if (count($articles) == 0) {
                                } else {
                                    $no = 0;
                                    foreach ($articles as $a) {
                                        if ($a->getAvailable() == "Y") {
                                            echo '<li class="paginate">
                                                    <div class="book-list-icon light-green-icon"></div>
                                                    <figure>
                                                    <form id="formA' . $no . '" target="_blank" action="?menu=details" method="post">
                                                        <a href="javascript:;" onclick="document.getElementById(' . "'formA$no'" . ').submit();">
                                                        <img src="' . $a->getUrl() . '" alt="Book"></a>
                                                        <input type="hidden" name="mess" value="' . $a->getId() . '"/>
                                                        <input type="hidden" name="type" value="2"/>
                                                    </form>
                                                        <figcaption>
                                                            <header>
                                                                <h4>
                                                                <form id="formA1' . $no . '" target="_blank" action="?menu=details" method="post">
                                                                    <a href="javascript:;" onclick="document.getElementById(' . "'formA1$no'" . ').submit();">
                                                                    ' . $a->getTitle() . '</a>
                                                                    <input type="hidden" name="mess" value="' . $a->getId() . '"/>
                                                                    <input type="hidden" name="type" value="2"/>
                                                                </form>
                                                                </h4>
                                                                <p><strong>Author:</strong> ' . strtotitle($a->getAuthors()) . '</p>
                                                                <p><strong>SNN:</strong>' . $a->getSSN() . '</p>
                                                            </header>
                                                            <p>' . strtotitle($a->getDescription()) . '</p>
                                                            
                                                        </figcaption>
                                                    </figure>
                                                </li>';
                                            $no += 1;
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                        <div class="pagination">
                            <div id="page-nav" class="page-nav"></div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- Start: Staff Picks -->
                <!-- End: Staff Picks -->
            </div>
        </main>
    </div>
</div>
<!-- End: Products Section -->
<section class="social-network section-padding">
</section>
<script type="text/javascript" src="jquery.simplePagination.js"></script>
<script type="text/javascript">
    jQuery(function($) {
        // Grab whatever we need to paginate
        var pageParts = $(".paginate");

        // How many parts do we have?
        var numPages = pageParts.length;
        // How many parts do we want per page?
        var perPage = 12;

        // When the document loads we're on page 1
        // So to start with... hide everything else
        pageParts.slice(perPage).hide();
        // Apply simplePagination to our placeholder
        $(".page-nav").pagination({
            items: numPages,
            itemsOnPage: perPage,
            // We implement the actual pagination
            //   in this next function. It runs on
            //   the event that a user changes page
            onPageClick: function(pageNum) {
                // Which page parts do we show?
                var start = perPage * (pageNum - 1);
                var end = start + perPage;

                // First hide all page parts
                // Then show those just for our page
                pageParts.hide()
                    .slice(start, end).show();
            }
        });
    });
</script>