<!doctype html>
<?php $pageTitle = 'dodaj wypożyczenie'; include('../shared/header.php') ?>

<?php
    if (isset($_POST['czytelnik']) && isset($_POST['ksiazka'])) {
        $identyfikator = $_SESSION['identyfikator'];
        $id_ksiazka = $_POST['ksiazka'];
        $id_czytelnik = $_POST['czytelnik'];

        include('../../controllers/connect.php');
        $conn = getConnection();

        if (!$conn) {
            $error = oci_error();
            die("Błąd połączenia z bazą danych: " . $error['message']);
        }

        $query = "BEGIN wypozycz_ksiazke(:id_ksiazka, :p_bibliotekarz, :p_czytelnik); END;";
        $stmt = oci_parse($conn, $query);

        oci_bind_by_name($stmt, ':id_ksiazka', $id_ksiazka);
        oci_bind_by_name($stmt, ':p_bibliotekarz', $identyfikator);
        oci_bind_by_name($stmt, ':p_czytelnik', $id_czytelnik);

        oci_execute($stmt);
        oci_commit($conn);

        // Sprawdzenie czy wypożyczenie zostało wykonane
        if (oci_num_rows($stmt) > 0) {
            echo 'Książka została wypożyczona.';
        } else {
            echo 'Książka jest niedostępna lub podany identyfikator bibliotekarza/czytelnika jest nieprawidłowy.';
        }

        oci_free_statement($stmt);
        oci_close($conn);
    }

    ?>



<body>
<?php $currentPage = 'wypozyczenia'; include('../shared/navbar.php') ?>

    <div class="container mt-5 mb-5">

        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowe wypożyczenie</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">

                <form method="POST" class="needs-validation" novalidate>


                <div class="form-group mb-2">
                    <label for="code">Czytelnik</label>
                    <div class="d-flex align-items-center">
                    <input class="form-control mr-3" aria-label="Default select example" name='czytelnik' id='czytelnik'></input>
                        <div class="invalid-feedback">Nieprawidłowy autor!</div>
                    </div>
                    </div>


                    <div class="form-group mb-2">
                    <label for="gatunek">Książka</label>
                    <div class="d-flex align-items-center">
                    <input class="form-control mr-3" aria-label="Default select example" name='ksiazka' id='ksiazka'></input>
                        <div class="invalid-feedback">Nieprawidłowy gatunek!</div>
                    </div>
                    </div>

                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-success" type="submit" value="Dodaj">
                    </div>

                </form>

            </div>
        </div>
    </div>

    <?php include('../shared/footer.php') ?>
</body>

</html>
