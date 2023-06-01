<!doctype html>
<?php $pageTitle = 'dodaj książkę'; include('../shared/header.php') ?>

<body>
<?php $currentPage = 'ksiazki'; include('../shared/navbar.php') ?>

    <div class="container mt-5 mb-5">

    <?php
use controllers\KsiazkiController;

if (isset($_POST['imie'])) {

    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];

    if(!isset($conn))
    include('../../controllers/connect.php');
    $conn = getConnection();

    if (!$conn) {
        $error = oci_error();
        die("Błąd połączenia z bazą danych: " . $error['message']);
    }

    $query = "BEGIN dodaj_autora(:imie, :nazwisko); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':imie', $imie);
    oci_bind_by_name($stmt, ':nazwisko', $nazwisko);

    try {
        $result = oci_execute($stmt);
        if($result)
        echo "Autor został dodany.";
    } catch (Exception $e) {
        $error = oci_error($stmt);
        echo "Nie udało się dodać autora przez bład lub autor już istnieje";
    }

    oci_free_statement($stmt);
    oci_close($conn);
}


?>

        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowego autora</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">
               
            <form method="POST" class="needs-validation" novalidate>

                    <div class="form-group mb-2">
                        <label for="imie">Imię</label>
                        <input id="imie" name="imie" type="text" class="form-control">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>

                    <div class="form-group mb-2">
                        <label for="nazwisko">Nazwisko</label>
                        <input id="nazwisko" name="nazwisko" type="text" class="form-control">
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
