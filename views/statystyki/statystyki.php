<!doctype html>

<?php
$pageTitle = 'statystyki';
include('../shared/header.php');
?>

<body>

  <?php
  $currentPage = 'statystyki';
  include('../shared/navbar.php');
  ?>

  <?php

  if (isset($_POST['data_od']) && isset($_POST['data_do'])) {

    $data_od = $_POST['data_od'];
    $data_do = $_POST['data_do'];

    include('../../controllers/connect.php');

    $conn = getConnection();


    // Przygotuj zapytanie do wywołania procedury
    $query = "BEGIN generuj_raport(TO_DATE(:data_od, 'YY-MM-DD'), TO_DATE(:data_do, 'YY-MM-DD')); END;";

    // Parsowanie zapytania
    $stmt = oci_parse($conn, $query);

    // Przypisanie wartości do parametrów
    oci_bind_by_name($stmt, ':data_od', $data_od);
    oci_bind_by_name($stmt, ':data_do', $data_do);

    $result = oci_execute($stmt);

    if ($result) {
      oci_commit($conn);
      echo "Wydawnictwo zostało dodane.";
    } else {
      $error = oci_error($stmt);
      echo "Błąd dodawania wydawnictwa: " . $error['message'];
    }

    // Zamykanie połączenia i zwalnianie zasobów
    oci_free_statement($stmt);
    oci_close($conn);

    echo "Raport został wygenerowany";
  }
  ?>



  <div class="container ">
    <h2 class='title mx-1'> Statystyki </h2>

    <button type="button" class="btn btn-right btn-dark ml-1 mx-1" onclick="nazwa()">Generuj raport</button>
    <div class='raport_label'></div>
    <script>
      function nazwa() {
        document.querySelector('.raport_label').innerHTML = 'Od: <form method="POST"> <input required id="data_od" name="data_od" class="form-control w-25" type="date" />' +
          ' Do: <input required id="data_do" name="data_do" class="form-control w-25" type="date" /><br>' +
          ' <button type="submit" class="btn btn btn-success w-25" onclick="">Dodaj</button></form>'
      }
    </script>


    <table class="table table-striped table-hover mt-sm-1 ">
      <thead class='bg-dark text-light rounded-1'>
        <tr>
          <th class='rounded-start'>ID raportu</th>
          <th>Data od</th>
          <th>Data do </th>
          <th>Liczba wypożyczeń</th>
          <th>Liczba zwrotów </th>
          <th>Naj. książka</th>
          <th>Naj. czytelnik</th>
          <th>Naj. bibliotekarz</th>

          <th class='rounded-end'> </th>
        </tr>
      </thead>
      <tbody>

        <?php

        require "../../controllers/RaportyController.php";

        use controllers\RaportyController;

        $raportController = new RaportyController();
        $raporty = 'raporty';
        $raportController->show($raporty);

        ?>

      </tbody>
    </table>
  </div>

  <?php
  include('../shared/footer.php');
  ?>

</body>

</html>