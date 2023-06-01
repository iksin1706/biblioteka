<!doctype html>

<?php
$pageTitle = 'czytelnicy';
include('../shared/header.php');
?>

  <body>

<?php
$currentPage = 'czytelnicy';
include('../shared/navbar.php');
?>


<div class="container ">
    <h2 class='title mx-1'> Czytelnicy </h2>
   
    <button type="button" class="btn btn-right btn-dark ml-1 mx-1" onclick="window.location.href='create.czytelnicy.php'">Dodaj czytelnika</button>

    <table class="table table-striped table-hover mt-sm-1 ">
        <thead class='bg-dark text-light rounded-1'>
        <tr>
        <th class='rounded-start'>ID Czytelnika</th>
          <th>Identyfikator</th>
            <th>Imię</th>
            <th>Nazwisko </th>
            <th>Email </th>
            <th>Pesel</th>
            <th>Nr. telefonu </th>
            <th class='rounded-end'> </th>
        </tr>
    </thead>
    <tbody>

    <?php

    require "../../controllers/CzytelnicyController.php";

    use controllers\CzytelnicyController;

    $czytelnicyController = new CzytelnicyController();
    $czytelnicy = 'czytelnicy';
    $czytelnicyController->show($czytelnicy);

?>

    </tbody>
  </table>
</div>

<?php
include('../shared/footer.php');
?>
 
</body>
</html>