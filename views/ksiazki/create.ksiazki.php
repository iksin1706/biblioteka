<!doctype html>
<?php $pageTitle = 'dodaj książkę';
include('../shared/header.php') ?>

<body>
    <?php $currentPage = 'ksiazki';
    include('../shared/navbar.php') ?>


    <?php


    if (isset($_POST['tytul'])) {

        $tytul = $_POST['tytul'];
        $rok = $_POST['rok'];
        $id_autor = $_POST['autor'];
        $id_wydawnictwo = $_POST['wydawnictwo'];
        $id_gatunek = $_POST['gatunek'];

        include('../../controllers/connect.php');
        $conn = getConnection();

        if (!$conn) {
            $error = oci_error();
            die("Błąd połączenia z bazą danych: " . $error['message']);
        }

        $query = "BEGIN INSERT INTO ksiazki(tytul, rok,id_autor, id_wydawnictwo, id_gatunek) 
          VALUES(:tytul, :rok, :id_autor, :id_wydawnictwo, :id_gatunek); END;";
        $stmt = oci_parse($conn, $query);

        oci_bind_by_name($stmt, ':tytul', $tytul);
        oci_bind_by_name($stmt, ':rok', $rok);
        oci_bind_by_name($stmt, ':id_autor', $id_autor);
        oci_bind_by_name($stmt, ':id_wydawnictwo', $id_wydawnictwo);
        oci_bind_by_name($stmt, ':id_gatunek', $id_gatunek);

        $result = oci_execute($stmt);

        if ($result) {
            oci_commit($conn);
            echo "Ksiazka została dodany.";
        } else {
            $error = oci_error($stmt);
            echo "Błąd dodawania ksiazki: " . $error['message'];
        }

        oci_free_statement($stmt);
        oci_close($conn);
    }

    ?>





    <div class="container mt-5 mb-5">

        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nową ksiązkę</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">

                <form method="POST" class="needs-validation" novalidate>


                    <div class="form-group mb-2">
                        <label for="code">Autor</label>
                        <div class="d-flex align-items-center">
                            <select name='autor' class="form-select mr-3" aria-label="Default select example">

                                <?php
                                require "../../controllers/KsiazkiController.php";

                                use controllers\KsiazkiController;

                                $ksiazkiController = new KsiazkiController();
                                $autor = 'autorzy';
                                $ksiazkiController->show_select($autor);
                                ?>

                            </select>
                            <button type="button" class="btn btn btn-success" onclick="window.location.href='create.autor.php'">+</button>
                            <div class="invalid-feedback">Nieprawidłowy autor!</div>
                        </div>
                    </div>


                    <div class="form-group mb-2">
                        <label for="gatunek">Gatunek</label>
                        <div class="d-flex align-items-center">
                            <select name='gatunek' class="form-select mr-3" aria-label="Default select example">

                                <?php
                                $gatunek = 'gatunki';
                                $ksiazkiController->show_select($gatunek);
                                ?>

                            </select>
                            <button type="button" class="btn btn btn-success" onclick="window.location.href='create.gatunek.php'">+</button>
                            <div class="invalid-feedback">Nieprawidłowy gatunek!</div>
                        </div>
                    </div>


                    <div class="form-group mb-2">
                        <label for="wydawnictwo">Wydawnictwo</label>
                        <div class="d-flex align-items-center">
                            <select name='wydawnictwo' class="form-select mr-3" aria-label="Default select example">

                                <?php
                                $wydawnictwo = 'wydawnictwa';
                                $ksiazkiController->show_select($wydawnictwo);
                                ?>

                            </select>
                            <button type="button" class="btn btn btn-success" onclick="window.location.href='create.wydawnictwo.php'">+</button>
                            <div class="invalid-feedback">Nieprawidłowe wydawnictwo!</div>
                        </div>
                    </div>


                    <div class="form-group mb-2">
                        <label for="tytuł">Tytuł</label>
                        <input id="tytuł" name="tytul" type="text" class="form-control">
                        <div class="invalid-feedback">Nieprawidłowa tytuł!</div>
                    </div>


                    <div class="form-group mb-2">
                        <label for="rok">Rok</label>
                        <input id="rok" name="rok" type="text" class="form-control">
                        <div class="invalid-feedback">Nieprawidłowy rok!</div>
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