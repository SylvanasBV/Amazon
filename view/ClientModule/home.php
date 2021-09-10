<?php
require_once('../business/ManageBook.php');
require_once('../business/ManagePresentation.php');
require_once('../business/ManageScienceArticle.php');
require_once('../persistence/util/Connection.php');
$con = new Connection();
$connection = $con->conectBD();

ManageBook::setConnectionBD($connection);
ManagePresentation::setConnectionBD($connection);
ManageScienceArticle::setConnectionBD($connection);
$countbook = 0;
$countpres = 0;
$countart = 0;
$books = ManageBook::listAll();
foreach ($books as $book) {
    $countbook++;
}
$books = ManagePresentation::listAll();
foreach ($books as $book) {
    $countpres++;
}
$books = ManageScienceArticle::listAll();
foreach ($books as $book) {
    $countart++;
}
?>
<style>
    .navbar-default .navbar-nav>.home>a,
    .navbar-default .navbar-nav>.home>a:hover,
    .navbar-default .navbar-nav>.home>a:focus {
        color: #ff7236;
        background-color: transparent;
    }
</style>
<div data-ride="carousel" class="carousel slide" id="home-v1-header-carousel">

    <!-- Carousel slides -->
    <div class="carousel-inner">
        <div class="item active">
            <figure>
                <img alt="Home Slide" src="https://trello-backgrounds.s3.amazonaws.com/SharedBackground/2400x1600/f83251a75f09041fa31badbdf2cab8d4/photo-1604213410393-89f141bb96b8.jpg" />
            </figure>
            <div class="container">
                <div class="carousel-caption">
                    <h3>Online Learning Anytime, Anywhere!</h3>
                    <h2>Discover Your Roots</h2>
                    <p>Build and discover your first stories around the best books, in a friendly environment willing to receive it
                         like that great world of feats that you have to tell us.</p>
                </div>
            </div>
        </div>
        <div class="item">
                <figure>
                    <img alt="Home Slide" src="images/books-scroll/2.jpg" />
                </figure>
                <div class="container">
                    <div class="carousel-caption">
                        <h3>Online Learning Anytime, Anywhere!</h3>
                        <h2>The value of a good book</h2>
                        <p>Book lovers know the importance of a good book and go over the 
                        books and learn new stories.</p>
    
                    </div>
                </div>
        </div>
        <div class="item">
                <figure>
                    <img alt="Home Slide" src="images/books-scroll/3.jpg" />
                </figure>
                <div class="container">
                    <div class="carousel-caption">
                        <h3>Online Learning Anytime, Anywhere!</h3>
                        <h2>Learn and discover</h2>
                        <p>The books that help you the most are the ones that make you think the most.
                         The most difficult way to learn is by reading, but a great book by a great thinker is a ship of thoughts,
                         discover these great books and documents in Amazonia.</p>
                    </div>
                </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#home-v1-header-carousel" data-slide="prev"></a>
    <a class="right carousel-control" href="#home-v1-header-carousel" data-slide="next"></a>
</div>
<!-- End: Slider Section -->

<!-- Start: Search Section -->
<section class="search-filters">
    <div class="container">
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
    </div>
</section>
<!-- End: Search Section -->

<!-- Start: Welcome Section -->
<section class="welcome-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="welcome-wrap">
                    <div class="welcome-text">
                        <h2 class="section-title">Welcome to Amazonía en Linea</h2>
                        <span class="underline left"></span>
                        <p class="lead">Celebrating Words, Ideas and Community</p>
                        <p>Libraries are important cornerstones of a healthy community.  Libraries give people the opportunity to find jobs, 
                        explore medical research, experience new ideas, get lost in wonderful stories, while at the same time providing a 
                        sense of place for gathering. The Amazonia en linea online library reflects the diversity and character, and the needs and expectations 
                        of our community.  Those needs and expectations are often extensive, and the services invaluable. Our library is a unique and valuable 
                        resource.  It is a lifeline to the world and all the information in it.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="facts-counter">
                    <ul>
                        <li class="bg-light-green">
                            <div class="fact-item">
                                <div class="fact-icon">
                                    <i class="ebook"></i>
                                </div>
                                <span>Books<strong class="fact-counter"><?php echo $countbook; ?></strong></span>
                            </div>
                        </li>
                        <li class="bg-yellow">
                            <div class="fact-item">
                                <div class="fact-icon">
                                    <i class="eaudio"></i>
                                </div>
                                <span>Lectures<strong class="fact-counter"><?php echo $countpres; ?></strong></span>
                            </div>
                        </li>
                        <li class="bg-red">
                            <div class="fact-item">
                                <div class="fact-icon">
                                    <i class="magazine"></i>
                                </div>
                                <span>Scientific <br>Articles<strong class="fact-counter"><?php echo $countart; ?></strong></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="welcome-image"></div>
</section>
<!-- End: Welcome Section -->

<!-- Start: Features -->
<section class="features">
    <div class="container">
        <ul>
            <li class="bg-yellow">
                <div class="feature-box">
                    <i class="yellow"></i>
                    <h3>Books</h3>
                    <p>Expand your knowledge or read cool stories with our selection of books!</p>
                    <form action="?menu=books" method="post" id="form1">
                        <input type="hidden" name="t" id="t" value="book">
                        <input type="hidden" name="keywords" id="keywords">
                        <a href="javascript:void(0);" class="yellow" onclick="document.getElementById('form1').submit();">View Selection <i class="fa fa-long-arrow-right"></i></a>
                    </form>

                </div>
            </li>
            <li class="bg-light-green">
                <div class="feature-box">
                    <i class="light-green"></i>
                    <h3>Lectures</h3>
                    <p>Missed a class? or are you looking for a refresher? Please help yourself to our selection of lectures!</p>
                    <form action="?menu=books" method="post" id="form2">
                        <input type="hidden" name="t" id="t" value="presentation">
                        <input type="hidden" name="keywords" id="keywords">
                        <a href="javascript:void(0);" class="yellow" onclick="document.getElementById('form2').submit();">View Selection <i class="fa fa-long-arrow-right"></i></a>
                    </form>
                </div>
            </li>
            <li class="bg-red">
                <div class="feature-box">
                    <i class="red"></i>
                    <h3>Scientific Articles</h3>
                    <p>Doing some research and don't know where to look? Our selection of science articles is here!</p>
                    <form action="?menu=books" method="post" id="form3">
                        <input type="hidden" name="t" id="t" value="sa">
                        <input type="hidden" name="keywords" id="keywords">
                        <a href="javascript:void(0);" class="yellow" onclick="document.getElementById('form3').submit();">View Selection <i class="fa fa-long-arrow-right"></i></a>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</section>
<!-- End: Features -->