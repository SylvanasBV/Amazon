<?php 
	if(isset($_GET['menu'])){
		if ($_GET['menu']=='home'){
			include_once('AdminModule/home.php');
		}
        if ($_GET['menu']=='books'){
			include_once('AdminModule/bookList.php');
		}
		if ($_GET['menu']=='details'){
			include_once('AdminModule/bookDetails.php');
		}
		if ($_GET['menu']=='newBook'){
			include_once('AdminModule/newBook.php');
		}
		if ($_GET['menu']=='docs'){
			include_once('AdminModule/docs.php');
		}
		if ($_GET['menu']=='users'){
			include_once('AdminModule/users.php');
		}
		if ($_GET['menu']=='registerNewUser'){
			include_once('AdminModule/registerNewUser.php');
		}
		if ($_GET['menu']=='audit'){
			include_once('AdminModule/audits.php');
		}
		if ($_GET['menu']=='booking'){
			include_once('AdminModule/booking.php');
		}
	} else {
		include_once('AdminModule/home.php');
	}
 ?>

