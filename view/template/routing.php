<?php
if (isset($_GET['menu'])) {
	if ($_GET['menu'] == 'home') {
		include_once('home.php');
	}
	if ($_GET['menu'] == 'books') {
		include_once('bookList.php');
	}
	if ($_GET['menu'] == 'signin') {
		include_once('login.php');
	}
	if ($_GET['menu'] == 'details') {
		include_once('bookDetails.php');
	}
} else {
	include_once('home.php');
}
?>
