<!doctype html>
<?php $pageTitle = 'dodaj wypożyczenie'; include('../shared/header.php') ?>

<body>
<?php $currentPage = 'wypozyczenia'; include('../shared/navbar.php') ?>

    <div class="container mt-5 mb-5">

        <div class="row mt-4 mb-4 text-center">
            <h1>Oddaj książkę</h1>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-6">

                <form method="POST" class="needs-validation" novalidate>


                <div class="form-group mb-2">
                    <label for="code">Czytelnik</label>
                    <div class="d-flex align-items-center">
                    <select class="form-select mr-3" aria-label="Default select example">
                        
                        <?php
                        require "../../controllers/KsiazkiController.php";

                        use controllers\KsiazkiController;

                        $ksiazkiController = new KsiazkiController();
                        $autor = 'autor';
                        $ksiazkiController->show_select($autor);
                        ?>

                        </select>
                        <div class="invalid-feedback">Nieprawidłowy autor!</div>
                    </div>
                    </div>


                    <div class="form-group mb-2">
                    <label for="gatunek">Książka</label>
                    <div class="d-flex align-items-center">
                    <select class="form-select mr-3" aria-label="Default select example">
                        
                        <?php
                        $gatunek = 'gatunek';
                        $ksiazkiController->show_select($gatunek);
                        ?>

                        </select>
                      
                        <div class="invalid-feedback">Nieprawidłowy gatunek!</div>
                    </div>
                    </div>

                    <div class="text-center mt-4 mb-4">
                        <input class="btn btn-success" type="submit" value="Oddaj">
                    </div>

                </form>

            </div>
        </div>
    </div>

    <?php include('../shared/footer.php') ?>
</body>

</html>
