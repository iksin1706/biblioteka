<!doctype html>
<?php $pageTitle = 'dodaj książkę'; include('../shared/header.php') ?>

<body>
<?php $currentPage = 'ksiazki'; include('../shared/navbar.php') ?>

    <div class="container mt-5 mb-5">

    <?php
// create.wydawnictwo.php
require "../../controllers/KsiazkiController.php";
use controllers\KsiazkiController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wydawnictwo = $_POST['wydawnictwo'];
    $wydawnictwo2 = 'wydawnictwa';
    $ksiazkiController = new KsiazkiController();
    $ksiazkiController->create_select($wydawnictwo,$wydawnictwo, $wydawnictwo2);
}


?>

        <div class="row mt-4 mb-4 text-center">
            <h1>Dodaj nowe wydawnictwo</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">
               
            <form method="POST" action="create.wydawnictwo.php" class="needs-validation" novalidate>

                    <div class="form-group mb-2">
                        <label for="area">Wydawnictwo</label>
                        <input id="area" name="wydawnictwo" type="text" class="form-control">
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
