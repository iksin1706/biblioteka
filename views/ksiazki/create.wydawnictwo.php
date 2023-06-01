<!doctype html>
<?php $pageTitle = 'dodaj książkę';
include('../shared/header.php') ?>

<body>
    <?php $currentPage = 'ksiazki';
    include('../shared/navbar.php') ?>

    <div class="container mt-5 mb-5">

        <?php
        // create.wydawnictwo.php
        use controllers\KsiazkiController;

        if (isset($_POST['wydawnictwo'])) {

            $wydawnictwo = $_POST['wydawnictwo'];

            if (!isset($conn))
                include('../../controllers/connect.php');
            $conn = getConnection();

            if (!$conn) {
                $error = oci_error();
                die("Błąd połączenia z bazą danych: " . $error['message']);
            }

            $query = "BEGIN dodaj_wydawnictwo(:wydawnictwo); END;";
            $stmt = oci_parse($conn, $query);

            oci_bind_by_name($stmt, ':wydawnictwo', $wydawnictwo);
            try {
                if (oci_execute($stmt)) {
                    echo "Wydawnictwo zostało dodane.";
                }
            } catch (Exception $e) {
                $error = oci_error($stmt);
                $errorMessage = "Nie udało się dodać wydawnictwa z powodu błędu lub istnieje już wydawnictwo o takiej nazwie";
                echo $errorMessage;
            }
            


            oci_free_statement($stmt);
            oci_close($conn);
        }

        ?>

        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowe wydawnictwo</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">

                <form method="POST" class="needs-validation" novalidate>

                    <div class="form-group mb-2">
                        <label for="wydawnictwo">Wydawnictwo</label>
                        <input id="wydawnictwo" name="wydawnictwo" type="text" class="form-control">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
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