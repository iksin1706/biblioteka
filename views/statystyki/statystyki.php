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


<div class="container ">
    <h2 class='title mx-1'> Statystyki </h2>
   
    <button type="button" class="btn btn-right btn-dark ml-1 mx-1" onclick="nazwa()">Generuj raport</button>
    <div class='raport_label'></div>
    <script>
    
      function nazwa()
      {
        document.querySelector('.raport_label').innerHTML='Od: <input required id="startDate" class="form-control w-25" type="date" />'
        +' Do: <input required id="startDate" class="form-control w-25" type="date" /><br>'
        +' <button type="button" class="btn btn btn-success w-25" onclick="">Dodaj</button>'
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
            <th >Naj. książka</th>
            <th >Naj. czytelnik</th>
            <th >Naj. bibliotekarz</th>

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