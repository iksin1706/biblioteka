<!doctype html>
<?php $pageTitle = 'dodaj książkę'; include('../shared/header.php') ?>

<body>
<?php $currentPage = 'ksiazki'; include('../shared/navbar.php') ?>

    <div class="container mt-5 mb-5">

    <?php

use controllers\KsiazkiController;

if (isset($_POST['gatunek'])) {
    $gatunek = $_POST['gatunek'];

    if (!isset($conn))
        include('../../controllers/connect.php');
    $conn = getConnection();

    if (!$conn) {
        $error = oci_error();
        die("Błąd połączenia z bazą danych: " . $error['message']);
    }

    $query = "BEGIN dodaj_gatunek(:gatunek); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':gatunek', $gatunek);

    if (oci_execute($stmt)) {
        echo '<script> alert(Gatunek zostal dodany")</script>';
    } else {
        $error = oci_error($stmt);
        echo '<script> alert("Nie udalo sie dodac gatunku")</script>';
    }

    oci_free_statement($stmt);
    oci_close($conn);
}



?>

        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowy gatunek</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">
               
            <form method="POST" action="create.gatunek.php" class="needs-validation" novalidate>

                    <div class="form-group mb-2">
                        <label for="gatunek">Gatunek</label>
                        <input id="gatunek" name="gatunek" type="text" class="form-control">
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
