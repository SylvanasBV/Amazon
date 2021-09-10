<?php 
	if(isset($_GET['menu'])){
		if ($_GET['menu']=='home'){
			include_once('ClientModule/home.php');
		}
        if ($_GET['menu']=='books'){
			include_once('ClientModule/bookList.php');
		}
		if ($_GET['menu']=='details'){
			include_once('ClientModule/bookDetails.php');
		}
		if ($_GET['menu']=='newBook'){
			include_once('ClientModule/newBook.php');
		}
		if ($_GET['menu']=='myBooks'){
			include_once('ClientModule/myBooks.php');
		}
		if ($_GET['menu']=='editBook'){
			include_once('ClientModule/editBook.php');
		}
	} else {
		include_once('ClientModule/home.php');
	}
 ?>

 