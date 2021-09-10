<?php

require_once('../business/ManageBook.php');
require_once('../business/ManagePresentation.php');
require_once('../business/ManageScienceArticle.php');
require_once('../persistence/util/Connection.php');
require_once('util.php');
$con = new Connection();
$connection = $con->conectBD();
$codUser = $_SESSION['cod_user'];
ManageBook::setConnectionBD($connection);
$books = ManageBook::consultByUser($codUser);

ManagePresentation::setConnectionBD($connection);
$papers = ManagePresentation::consultByUser($codUser);

ManageScienceArticle::setConnectionBD($connection);
$articles = ManageScienceArticle::consultByUser($codUser);

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
</style>
<!-- Start: Page Banner -->
<section class="page-banner services-banner">
    <div class="container">
        <div class="banner-header">
            <h2>Books & Media</h2>
            <span class="underline center"></span>
            <p class="lead"></p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="?menu=home">Home</a></li>
                <li>My Documents</li>
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
                    </section>
                    <!-- End: Search Section -->
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
                                                                ' . mb_strimwidth($b->getTitle(), 0, 35, "...") . '</a>
                                                                <input type="hidden" name="mess" value="' . $b->getId() . '"/>
                                                                <input type="hidden" name="type" value="0"/>
                                                            </form>
                                                            </h4>
                                                            <p><strong>Author:</strong> ' . $b->getAuthors() . '</p>
                                                            <p><strong>ISBN:</strong>' . $b->getISBN() . '</p>
                                                            <p>' . mb_strimwidth(strtotitle($b->getDescription()), 0, 85, "...") . '</p>
                                                            <div class="actions">
                                                                <ul>
                                                                    <li style="margin: 0px 0px 0px 0px;">
                                                                        <form id="form3B' . $no . '" target="_blank" action="?menu=editBook" method="post">
                                                                            <a href="javascript:;" onclick="document.getElementById(' . "'form3B$no'" . ').submit();" data-toggle="blog-tags" data-placement="top" title="Edit">
                                                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                                            </a>
                                                                            <input type="hidden" name="mess" value="' . $b->getId() . '"/>
                                                                            <input type="hidden" name="type" value="0"/>
                                                                        </form>
                                                                       
                                                                    </li>
    
                                                                </ul>
                                                            </div>
                                                        </header>
                                                    </figcaption>
                                                </figure>
                                            </li>';
                                    $no += 1;
                                }
                            }
                            if (count($papers) == 0) {
                            } else {
                                $no = 0;
                                foreach ($papers as $b) {
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
                                                                ' . mb_strimwidth($b->getTitle(), 0, 35, "...") . '</a>
                                                                <input type="hidden" name="mess" value="' . $b->getId() . '"/>
                                                                <input type="hidden" name="type" value="1"/>
                                                            </form>
                                                            </h4>
                                                            <p><strong>Author:</strong> ' . $b->getAuthors() . '</p>
                                                            <p><strong>ISBN:</strong>' . $b->getISBN() . '</p>
                                                            <p>' .  mb_strimwidth(strtotitle($b->getDescription()), 0, 85, "...") . '</p>
                                                            <div class="actions">
                                                                <ul>
                                                                    <li style="margin: 0px 0px 0px 0px;">
                                                                        <form id="form3P' . $no . '" target="_blank" action="?menu=editBook" method="post">
                                                                            <a href="javascript:;" onclick="document.getElementById(' . "'form3P$no'" . ').submit();" data-toggle="blog-tags" data-placement="top" title="Edit">
                                                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                                            </a>
                                                                            <input type="hidden" name="mess" value="' . $b->getId() . '"/>
                                                                            <input type="hidden" name="type" value="1"/>
                                                                        </form>
                                                                    
                                                                    </li>

                                                                </ul>
                                                            </div>

                                                        </header>
                                                    </figcaption>
                                                </figure>
                                            </li>';
                                    $no += 1;
                                }
                            }
                            if (count($articles) == 0) {
                            } else {
                                $no = 0;
                                foreach ($articles as $a) {
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
                                                                ' . mb_strimwidth($a->getTitle(), 0, 35, "...")  . '</a>
                                                                <input type="hidden" name="mess" value="' . $a->getId() . '"/>
                                                                <input type="hidden" name="type" value="2"/>
                                                            </form>
                                                            </h4>
                                                            <p><strong>Author:</strong> ' . $a->getAuthors() . '</p>
                                                            <p><strong>SNN:</strong>' . $a->getSSN() . '</p>
                                                            <p>' .  mb_strimwidth(strtotitle($a->getDescription()), 0, 85, "...") . '</p>
                                                            <div class="actions">
                                                                <ul>
                                                                    <li style="margin: 0px 0px 0px 0px;">
                                                                        <form id="form3A' . $no . '" target="_blank" action="?menu=editBook" method="post">
                                                                            <a href="javascript:;" onclick="document.getElementById(' . "'form3A$no'" . ').submit();" data-toggle="blog-tags" data-placement="top" title="Edit">
                                                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                                            </a>
                                                                            <input type="hidden" name="mess" value="' . $a->getId() . '"/>
                                                                            <input type="hidden" name="type" value="2"/>
                                                                        </form>
                                                                       
                                                                    </li>
    
                                                                </ul>
                                                            </div>
                                                        </header>
                                                    </figcaption>
                                                </figure>
                                            </li>';
                                    $no += 1;
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="pagination">
                        <div id="page-nav" class="page-nav"></div>
                    </div>
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