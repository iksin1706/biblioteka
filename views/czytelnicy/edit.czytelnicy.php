<?php

use controllers\CzytelnicyController;

if (isset($_GET['id'])) {
    $id_czytelnika = $_GET['id'];

    // Pobranie danych czytelnika o podanym ID

    include('../../controllers/connect.php');
    $conn = getConnection();

    if (!$conn) {
        $error = oci_error();
        die("Błąd połączenia z bazą danych: " . $error['message']);
    }

    $query = "SELECT * FROM czytelnicy WHERE id_czytelnik = :id";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':id', $id_czytelnika);
    $result = oci_execute($stmt);

    if (!$result) {
        $error = oci_error($stmt);
        echo "Błąd pobierania danych czytelnika: " . $error['message'];
        oci_free_statement($stmt);
        oci_close($conn);
        exit;
    }

    // Sprawdzenie czy znaleziono czytelnika o podanym ID
    if (($row = oci_fetch_assoc($stmt)) !== false) {
        $imie = $row['IMIE'];
        $nazwisko = $row['NAZWISKO'];
        $email = $row['EMAIL'];
        $pesel = $row['PESEL'];
        $telefon = $row['NR_TELEFONU'];

        // Wyświetlenie formularza edycji z wypełnionymi danymi

        ?>
        
        <!doctype html>
        <?php $pageTitle = 'Edytuj czytelnika'; include('../shared/header.php') ?>
        
        <body>
        <?php $currentPage = 'czytelnicy'; include('../shared/navbar.php') ?>
        
            <div class="container mt-5 mb-5">
        
            <?php
        
            if (isset($_POST['imie'])) {
        
                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $email = $_POST['email'];
                $pesel = $_POST['pesel'];
                $telefon = $_POST['phone'];
                
                if(!isset($conn))
                include('../../controllers/connect.php');
                $conn = getConnection();
        
                if (!$conn) {
                    $error = oci_error();
                    die("Błąd połączenia z bazą danych: " . $error['message']);
                }
        
                $query = "UPDATE czytelnicy SET imie = :imie, nazwisko = :nazwisko, email = :email, pesel = :pesel, nr_telefonu = :telefon WHERE id_czytelnik = :id";
                $stmt = oci_parse($conn, $query);
        
                oci_bind_by_name($stmt, ':imie', $imie);
                oci_bind_by_name($stmt, ':nazwisko', $nazwisko);
                oci_bind_by_name($stmt, ':email', $email);
                oci_bind_by_name($stmt, ':pesel', $pesel);
                oci_bind_by_name($stmt, ':telefon', $telefon);
                oci_bind_by_name($stmt, ':id', $id_czytelnika);
        
                if (oci_execute($stmt)) {
                    echo '<script> alert("Czytelnik zostal zaktualizowany pomyślnie")</script>';
                } else {
                    $error = oci_error($stmt);
                    echo '<script> alert("Nie udalo sie zaaktualizowac czytelnika")</script>';
                }
        
                oci_free_statement($stmt);
                oci_close($conn);
            }
        
            ?>
        
                <div class="row mt-4 mb-4 text-center">
                    <h1>Edytuj czytelnika</h1>
                </div>
        
                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                       
                    <form method="POST" class="needs-validation" novalidate>
        
                            <div class="form-group mb-2">
                                <label for="imie">Imię</label>
                                <input id="imie" name="imie" type="text" class="form-control" required value="<?php echo $imie; ?>">
                                <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                            </div>
        
                            <div class="form-group mb-2">
                                <label for="nazwisko">Nazwisko</label>
                                <input id="nazwisko" name="nazwisko" type="text" class="form-control" required value="<?php echo $nazwisko; ?>">
                                <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                            </div>
        
                            <div class="form-group mb-2">
                                <label for="email">E-mail</label>
                                <input id="email" name="email" type="e-mail" class="form-control" required value="<?php echo $email; ?>">
                                <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                            </div>
        
                            
                            <div class="form-group mb-2">
                                <label for="pesel">Pesel</label>
                                <input id="pesel" name="pesel" type="number" class="form-control" required value="<?php echo $pesel; ?>">
                                <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                            </div>
        
                            
                            <div class="form-group mb-2">
                                <label for="phone">Nr. telefonu</label>
                                <input id="phone" name="phone" type="phone" class="form-control" required value="<?php echo $telefon; ?>">
                                <div class="invalid-feedback">Nieprawidłowa nazwa!</div>
                            </div>
        
                            <div class="text-center mt-4 mb-4">
                                <input class="btn btn-success" type="submit" value="Zapisz"> 
                            </div>
                        </form>
        
                    </div>
                </div>
            </div>
        
            <?php include('../shared/footer.php') ?>
        </body>
        
        </html>
        
        <?php
    } else {
        echo "Nie znaleziono czytelnika o podanym ID.";
    }
} else {
    echo "Nie podano ID czytelnika.";
}
?>
