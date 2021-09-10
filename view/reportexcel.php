<?php
header('Content-type:application/vnd.ms-excel; charset=UTF-8"');
header('Content-Disposition: attachment; filename=reportExcel.xls');

require_once('../business/ManageBook.php');
require_once('../business/ManagePresentation.php');
require_once('../business/ManageScienceArticle.php');
require_once('../persistence/util/Connection.php');

header('Content-Type: text/html; charset=UTF-8');
?>

<?php

$con = new Connection();
$connection = $con->conectBD();
ManageBook::setConnectionBD($connection);
$books = ManageBook::listAll();

ManagePresentation::setConnectionBD($connection);
$papers = ManagePresentation::listAll();

ManageScienceArticle::setConnectionBD($connection);
$articles = ManageScienceArticle::listAll();

$results = count($books) + count($papers) + count($articles);

?>

<table>
    <tr>
        <td colspan="4" style="border:1px solid;background-color: #3c3c3c;color:white;text-align:center;">List of Books</td>
    </tr>
    <tr>
        <th style="background-color: #46D900">ID</th>
        <th style="background-color: #46D900">Title</th>
        <th style="background-color: #46D900">Authors</th>
        <th style="background-color: #46D900">Description</th>
    </tr>
    <?php
    if ($results == 0) {
    } else {
        foreach ($books as $b) {
            $des = str_replace('\r', '', utf8_decode($b->getDescription()));
            $des = str_replace('\n', '', $des);
            $des = str_replace('<i>', '', $des);

            echo "<tr>
                      <td style='border:1px solid;'>" . utf8_decode($b->getId()) . "</td>
                      <td style='border:1px solid;'>" . utf8_decode($b->getTitle()) . "</td>
                      <td style='border:1px solid;'>" . utf8_decode($b->getAuthors()) . "</td>
                      <td style='border:1px solid;'>" . $des . "</td>
                 </tr>";
    ?>


    <?php
        }
        echo '<tr><td colspan="4" style="text-align:center;background-color: #CCCCCC;font-size:30px">Total: ' . count($books) . '</td></tr>';
    }
    ?>
</table>
<table>
    <tr>
        <td colspan="4" style="border:1px solid;background-color: #3c3c3c;color:white;text-align:center;">List of Papers</td>
    </tr>
    <tr>
        <th style="background-color: #46D900">ID</th>
        <th style="background-color: #46D900">Title</th>
        <th style="background-color: #46D900">Authors</th>
        <th style="background-color: #46D900">Description</th>
    </tr>
    <?php
    if ($results == 0) {
    } else {
        foreach ($papers as $b) {
            $des = str_replace('\r', '', utf8_decode($b->getDescription()));
            $des = str_replace('\n', '', $des);
            $des = str_replace('<i>', '', $des);


            echo "<tr>
                      <td style='border:1px solid;'>" . utf8_decode($b->getId()) . "</td>
                      <td style='border:1px solid;'>" . utf8_decode($b->getTitle()) . "</td>
                      <td style='border:1px solid;'>" . utf8_decode($b->getAuthors()) . "</td>
                      <td style='border:1px solid;'>" . $des . "</td>
                 </tr>";
    ?>


    <?php
        }
        echo '<tr><td colspan="4" style="text-align:center;background-color: #CCCCCC;font-size:30px">Total: ' . count($papers) . '</td></tr>';
    }
    ?>
</table>
<table>
    <tr>
        <td colspan="4" style="border:1px solid;background-color: #3c3c3c;color:white;text-align:center;">List of Science Articles</td>
    </tr>
    <tr>
        <th style="background-color: #46D900">ID</th>
        <th style="background-color: #46D900">Title</th>
        <th style="background-color: #46D900">Authors</th>
        <th style="background-color: #46D900">Description</th>
    </tr>
    <?php
    if ($results == 0) {
    } else {
        foreach ($articles as $b) {
            $des = str_replace('\r', '', utf8_decode($b->getDescription()));
            $des = str_replace('\n', '', $des);
            $des = str_replace('<i>', '', $des);

            echo "<tr>
                      <td style='border:1px solid;'>" . utf8_decode($b->getId()) . "</td>
                      <td style='border:1px solid;'>" . utf8_decode($b->getTitle()) . "</td>
                      <td style='border:1px solid;'>" . utf8_decode($b->getAuthors()) . "</td>
                      <td style='border:1px solid;'>" . $des . "</td>
                 </tr>";
    ?>


    <?php
        }
        echo '<tr><td colspan="4" style="text-align:center;background-color: #CCCCCC;font-size:30px">Total: ' . count($articles) . '</td></tr>';
    }
    ?>
</table>