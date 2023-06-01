<!doctype html>
<?php $pageTitle = 'dodaj bibliotekarza';
include('../shared/header.php') ?>

<body>
    <?php $currentPage = 'bibliotekarz';
    include('../shared/navbar.php') ?>

    <div class="container mt-5 mb-5">

        <?php

        use controllers\KsiazkiController;

        if (isset($_POST['imie'])) {

            $pesel = $_POST['pesel'];
            $telefon = $_POST['phone'];
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];

            include('../../controllers/connect.php');
            $conn = getConnection();

            if (!$conn) {
                $error = oci_error();
                die("Błąd połączenia z bazą danych: " . $error['message']);
            }

            $query = "BEGIN INSERT INTO bibliotekarze(imie, nazwisko, pesel, nr_telefonu) 
              VALUES(:imie, :nazwisko, :pesel, :telefon); END;";
            $stmt = oci_parse($conn, $query);

            oci_bind_by_name($stmt, ':imie', $imie);
            oci_bind_by_name($stmt, ':nazwisko', $nazwisko);
            oci_bind_by_name($stmt, ':pesel', $pesel);
            oci_bind_by_name($stmt, ':telefon', $telefon);

            $result = oci_execute($stmt);

            if ($result) {
                oci_commit($conn);
                echo "Bibliotekarz został dodany.";
            } else {
                $error = oci_error($stmt);
                echo "Błąd dodawania bibliotekarza: " . $error['message'];
            }

            oci_free_statement($stmt);
            oci_close($conn);
        }


        ?>

        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowego bibliotekarza</h1>
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


                    <div class="form-group mb-2">
                        <label for="pesel">Pesel</label>
                        <input id="pesel" name="pesel" type="number" class="form-control">
                        <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                    </div>


                    <div class="form-group mb-2">
                        <label for="phone">Nr. telefonu</label>
                        <input id="phone" name="phone" type="phone" class="form-control">
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