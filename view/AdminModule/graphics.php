<?php
require_once('../business/ManageBook.php');
require_once('../business/ManagePresentation.php');
require_once('../business/ManageScienceArticle.php');
require_once('../business/ManageUser.php');
require_once('../business/ManageBooking.php');
require_once('../business/ManageAudit.php');

require_once('../persistence/util/Connection.php');

$con = new Connection();
$connection = $con->conectBD();

ManageBook::setConnectionBD($connection);
$books = ManageBook::listAll();

ManagePresentation::setConnectionBD($connection);
$papers = ManagePresentation::listAll();

ManageScienceArticle::setConnectionBD($connection);
$articles = ManageScienceArticle::listAll();

ManageUser::setConnectionBD($connection);
$users = ManageUser::listAll();

ManageBooking::setConnectionBD($connection);
$bookings = ManageBooking::listAll();

ManageAudit::setConnectionBD($connection);
$audits = ManageAudit::listAll();

?>
<script>
  function graf() {

    if ($("#bar-graphic1").length) {
      <?php
      $numBooksN = 0;
      $numBooksY = 0;
      $numPapersY = 0;
      $numPapersN = 0;
      $numArticlesY = 0;
      $numArticlesN = 0;

      foreach ($books as $book) {
        if ($book->getAvailable() == 'Y') {
          $numBooksY += 1;
        } else {
          $numBooksN += 1;
        }
      }
      foreach ($papers as $paper) {
        if ($paper->getAvailable() == 'Y') {
          $numPapersY += 1;
        } else {
          $numPapersN += 1;
        }
      }
      foreach ($articles as $article) {
        if ($article->getAvailable() == 'Y') {
          $numArticlesY += 1;
        } else {
          $numArticlesN += 1;
        }
      }

      ?>
      var BarData = {
        labels: ["Books", "Papers", "Articles"],
        datasets: [{
            label: 'Available',
            data: [<?php echo $numBooksY ?>, <?php echo $numPapersY ?>, <?php echo $numArticlesY ?>],
            backgroundColor: chartColors[0],
            borderColor: chartColors[0],
            borderWidth: 0
          },
          {
            label: 'Not Available',
            data: [<?php echo $numBooksN ?>, <?php echo $numPapersN ?>, <?php echo $numArticlesN ?>],
            backgroundColor: chartColors[1],
            borderColor: chartColors[1],
            borderWidth: 0
          }
        ]
      };
      var barChartCanvas = $("#bar-graphic1").get(0).getContext("2d");
      var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: BarData,
        options: {
          tooltips: {
            mode: 'index',
            intersect: false
          },
          responsive: true,
          scales: {
            xAxes: [{
              stacked: true,
            }],
            yAxes: [{
              stacked: true
            }]
          },
          legend: false
        }
      });
    }

    if ($("#donut-graphic1").length) {
      <?php
      $numUsersA = 0;
      $numUsersD = 0;

      foreach ($users as $user) {
        if ($user->getStatus() == 'activo') {
          $numUsersA += 1;
        } else {
          $numUsersD += 1;
        }
      }

      ?>
      var DoughnutData = {
        datasets: [{
          data: [<?php echo $numUsersA ?>, <?php echo $numUsersD ?>],
          backgroundColor: chartColors,
          borderColor: chartColors,
          borderWidth: chartColors
        }],
        labels: [
          'Active Users',
          'Inactive Users',
        ]
      };
      var DoughnutOptions = {
        responsive: true,
        animation: {
          animateScale: true,
          animateRotate: true
        }
      };
      var doughnutChartCanvas = $("#donut-graphic1").get(0).getContext("2d");
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'doughnut',
        data: DoughnutData,
        options: DoughnutOptions
      });
    }

    if ($("#bar-graphic2").length) {
      <?php
      $numBooks = 0;
      $numPapers = 0;
      $numArticles = 0;

      foreach ($bookings as $booking) {
        if ($booking->getType_document() == 'book' && $booking->getAvailable() == 'Y') {
          $numBooks += 1;
        } else if ($booking->getType_document() == 'presentation' && $booking->getAvailable() == 'Y') {
          $numPapers += 1;
        } else if ($booking->getType_document() == 'sciencearticle' && $booking->getAvailable() == 'Y') {
          $numArticles += 1;
        }
      }

      ?>
      var BarData = {
        labels: ["Books", "Papers", "Articles"],
        datasets: [{
          label: 'Number of Bookings',
          data: [<?php echo $numBooks ?>, <?php echo $numPapers ?>, <?php echo $numArticles ?>],
          backgroundColor: chartColors,
          borderColor: chartColors,
          borderWidth: 0
        }]
      };
      var barChartCanvas = $("#bar-graphic2").get(0).getContext("2d");
      var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: BarData,
        options: {
          scales: {
            yAxes: [{
              display: true,
              ticks: {
                suggestedMin: 0,
                beginAtZero: true
              }
            }]
          },
          fill: false,
          legend: false
        }
      });
    }

    if ($("#radar-graphic1").length) {
      var marksCanvas = document.getElementById("radar-graphic1");
      <?php
      $insert = 0;
      $update = 0;
      $delete = 0;

      foreach ($audits as $audit) {
        if ($audit->getAction() == 'Insert') {
          $insert += 1;
        } else if ($audit->getAction() == 'Update') {
          $update += 1;
        } else {
          $delete += 1;
        }
      }

      ?>

      var marksData = {
        labels: ["Insert", "Update", "Delete"],
        datasets: [{
          label: "Action number",
          data: [<?php echo $insert ?>, <?php echo $update ?>, <?php echo $delete ?>],
          backgroundColor: chartColors[2],
          borderColor: chartColors[2],
          borderWidth: 3
        }]
      };

      var radarChart = new Chart(marksCanvas, {
        type: 'radar',
        data: marksData
      });
    }





  }
</script>