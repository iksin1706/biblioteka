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
   
    <button type="button" class="btn btn-right btn-dark ml-1 mx-1" onclick="window.location.href='create.wypozyczenia.php'">Dodaj wypożyczenie</button>
    <button type="button" class="btn btn-right btn-dark mx-1" onclick="window.location.href='oddajksiazki.php'">Oddaj książkę</button>
    <button type="button" class="btn btn-right btn-outline-dark mx-1" onclick="window.location.href='dostepneksiazki.php'">Dostępne książki</button>
    


    <table class="table table-striped table-hover mt-sm-1 ">
        <thead class='bg-dark text-light rounded-1'>
        <tr>
            <th class='rounded-start'>ID wypożyczenia</th>
            <th>Imie i nazwisko bibliotekarza</th>
            <th>Imie i nazwisko czytelnika </th>
            <th>Nazwa książki</th>
            <th>Data wypożyczenia </th>
            <th >Data oddania </th>
            <th class='rounded-end'> </th>
        </tr>
    </thead>
    <tbody>

    <?php

    require "../../controllers/WypozyczeniaController.php";

    use controllers\WypozyczeniaController;

    $wypozyczeniaController = new WypozyczeniaController();
    $wypozyczenia = 'wypożyczenie';
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