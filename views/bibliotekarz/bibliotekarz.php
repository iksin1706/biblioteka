<!doctype html>

<?php
$pageTitle = 'bibliotekarz';
include('../shared/header.php');
?>

  <body>

<?php
$currentPage = 'bibliotekarz';
include('../shared/navbar.php');
?>


<div class="container ">
    <h2 class='title mx-1'> Bibliotekarz </h2>
   
    <button type="button" class="btn btn-right btn-dark ml-1 mx-1" onclick="window.location.href='create.bibliotekarz.php'">Dodaj bibliotekarza</button>

    <table class="table table-striped table-hover mt-sm-1 ">
        <thead class='bg-dark text-light rounded-1'>
        <tr>
        <th class='rounded-start'>ID bibliotekarz</th>
            <th>Imię</th>
            <th>Nazwisko </th>
            <th>Pesel</th>
            <th>Nr. telefonu </th>
            <th class='rounded-end'> </th>
        </tr>
    </thead>
    <tbody>

    <?php

    require "../../controllers/BibliotekarzController.php";

    use controllers\BibliotekarzController;

    $bibliotekarzController = new BibliotekarzController();
    $bibliotekarz = 'bibliotekarze';
    $bibliotekarzController->show($bibliotekarz);

?>

    </tbody>
  </table>
</div>

<?php
include('../shared/footer.php');
?>
 
</body>
</html>