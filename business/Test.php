<?php
require_once($_SERVER["DOCUMENT_ROOT"]).'/Amazonia/business/Book.php';
$id = new Book();
echo $id->getTitle();
?>

