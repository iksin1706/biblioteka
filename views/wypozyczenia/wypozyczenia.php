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

    <?php

    if (isset($_GET['zwrot'])) {
        $id = $_GET['zwrot'];

        require('../../controllers/connect.php');

        $conn = getConnection();

        if (!$conn) {
            $error = oci_error();
            die("Błąd połączenia z bazą danych: " . $error['message']);
        }

        // Przygotowanie i wykonanie zapytania do procedury
        $query = "BEGIN oddaj_ksiazke(:id_wypozyczenia); END;";
        $stmt = oci_parse($conn, $query);

        oci_bind_by_name($stmt, ':id_wypozyczenia', $id);

        oci_execute($stmt);
        oci_commit($conn);

        // Sprawdzenie czy oddanie książki zostało wykonane
        if (oci_num_rows($stmt) > 0) {
            echo 'Książka została pomyślnie oddana.';
        } else {
            echo 'Błąd: Brak wypożyczenia o podanym ID.';
        }

        oci_free_statement($stmt);
        oci_close($conn);
    }

    ?>



    <div class="container ">
        <h2 class='title mx-1'> Wypożyczenia </h2>

        <button type="button" class="btn btn-right btn-dark m-1 mb-1 mx-1" onclick="window.location.href='create.wypozyczenia.php'">Wypożycz książke</button><br>
        <button type="button" class="btn btn-right btn-dark ml-1 mx-1" onclick="window.location.href='wypozyczenia.php'">Wszystkie wypożyczenia</button>
        <button type="button" class="btn btn-right btn-outline-dark mx-1" onclick="window.location.href='aktywne-wypozyczenia.php'">Aktywne wypożyczenia</button>
        <button type="button" class="btn btn-right btn-outline-dark mx-1" onclick="window.location.href='opoznione-wypozyczenia.php'">Opoznione wypożyczenia</button>
        <?php echo $_SESSION['identyfikator'] ?>
        <table class="table table-striped table-hover mt-sm-1 ">
            <thead class='bg-dark text-light rounded-1'>
                <tr>
                    <th class='rounded-start'>ID wypożyczenia</th>
                    <th>Bibliotekarz</th>
                    <th>Czytelnik </th>
                    <th>Id_ksiazki</th>
                    <th>Data wypożyczena </th>
                    <th>Data oddania </th>
                    <th> Czy opoznione </th>
                    <th class='rounded-end'> Przyjmij zwrot </th>
                </tr>
            </thead>
            <tbody>

                <?php

                require "../../controllers/WypozyczeniaController.php";

                use controllers\WypozyczeniaController;

                $wypozyczeniaController = new WypozyczeniaController();
                $wypozyczenia = 'wypozyczenia_widok';
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