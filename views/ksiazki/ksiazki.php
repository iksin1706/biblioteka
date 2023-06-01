<!doctype html>

<?php
$pageTitle = 'książki';
include('../shared/header.php');
?>

  <body>

<?php
$currentPage = 'ksiazki';
include('../shared/navbar.php');
?>


<div class="container ">
    <h2 class='title mx-1'> Książki </h2>
   
    <button type="button" class="btn btn-right btn-dark ml-1 mx-1" onclick="window.location.href='create.ksiazki.php'">Dodaj książkę</button>
    <button type="button" class="btn btn-right btn-outline-dark mx-1" onclick="window.location.href='autorzy.php'">Autorzy</button>
    <button type="button" class="btn btn-right btn-outline-dark mx-1" onclick="window.location.href='gatunki.php'">Gatunki</button>
    <button type="button" class="btn btn-right btn-outline-dark mx-1" onclick="window.location.href='wydawnictwa.php'">Wydawnictwa</button>
    <table class="table table-striped table-hover mt-sm-1 ">
        <thead class='bg-dark text-light rounded-1'>
        <tr>
        <th class='rounded-start'>ID Książki</th>
            <th>Autor</th>
            <th>Gatunek </th>
            <th>Wydawnictwo</th>
            <th>Tytuł </th>
            <th class='rounded-end'>Rok</th>
        </tr>
    </thead>
    <tbody>

    <?php

    require "../../controllers/KsiazkiController.php";

    use controllers\KsiazkiController;

    $ksiazkiController = new KsiazkiController();
    $ksiazka = 'dostepne_ksiazki';
    $ksiazkiController->show($ksiazka);

?>

    </tbody>
  </table>
</div>

<?php
include('../shared/footer.php');
?>
 
</body>
</html>