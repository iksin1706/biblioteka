<!doctype html>

<?php
$pageTitle = 'wypożyczenia';
include('../shared/header.php');
?>

  <body>

<?php
$currentPage = 'wypozyczenia';
include('../shared/navbar.php');
?>


<div class="container ">
    <h2 class='title mx-1'> Wypożyczenia </h2>

    <button type="button" class="btn btn-right btn-dark m-1 mb-1 mx-1" onclick="window.location.href='create.wypozyczenia.php'">Wypożycz książke</button><br>
    <button type="button" class="btn btn-right btn-outline-dark mx-1" onclick="window.location.href='wypozyczenia.php'">Wszystkie wypożyczenia</button>
    <button type="button" class="btn btn-right btn-outline-dark mx-1" onclick="window.location.href='aktywne-wypozyczenia.php'">Aktywne wypożyczenia</button>
    <button type="button" class="btn btn-right btn-dark ml-1 mx-1" onclick="window.location.href='opoznione-wypozyczenia.php'">Opoznione wypożyczenia</button>

    <table class="table table-striped table-hover mt-sm-1 ">
        <thead class='bg-dark text-light rounded-1'>
        <tr>
            <th class='rounded-start'>ID wypożyczenia</th>
            <th>Bibliotekarz</th>
            <th>Czytelnik </th>
            <th>Id_ksiazki</th>
            <th>Data wypożyczenia </th>
            <th >Data oddania </th>
            <th class='rounded-end'> Czy opoznione </th>
        </tr>
    </thead>
    <tbody>

    <?php

    require "../../controllers/WypozyczeniaController.php";

    use controllers\WypozyczeniaController;

    $wypozyczeniaController = new WypozyczeniaController();
    $wypozyczenia = 'opoznione_wypozyczenia';
    $wypozyczeniaController->show($wypozyczenia);

?>

    </tbody>
  </table>
</div>

<?php
include('../shared/footer.php');
?>
 
</body>
</html>