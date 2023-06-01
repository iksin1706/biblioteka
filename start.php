<!doctype html>

<?php
$pageTitle = 'Start';
include('views/shared/header.php');

if (isset($_POST['submit'])) {
  $error = "";
  require("controllers/connect.php");
  $conn=getConnection();
  $identyfikator = $_POST['identyfikator'];
  $stmt = oci_parse($conn, 'SELECT COUNT(*) FROM bibliotekarze WHERE identyfikator = :identyfikator');
  oci_bind_by_name($stmt, ':identyfikator', $identyfikator);
  oci_execute($stmt);

  $row = oci_fetch_array($stmt);
  $count = $row[0];

  if ($count > 0) {
    if ($identyfikator) {
      $_SESSION['identyfikator'] = $identyfikator;
      echo "<script>window.location='views/wypozyczenia/wypozyczenia.php' </script>";
    } else $error = "Niepoprawny identyfikator";
  } else {
    echo 'Bibliotekarz nie istnieje.';
  }

  oci_free_statement($stmt);


}

?>

<body>

  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">Biblioteka</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="start.php">Start</a>
          </li>
      </div>
    </div>
  </nav>


  <div class="row mt-4 mb-4 text-center">
    <h1>Start</h1>
  </div>

  <div class="row d-flex justify-content-center">
    <div class="col-6">

      <div class="form-group mb-2">
        <form method="post">
          <label for="rok">Prosze podaj id bibliotekarza</label>
          <input id="identyfikator" name="identyfikator" type="text" class="form-control">
          <?php if(isset($_POST['submit'])) echo '<div class="invalid-feedback">Nieprawidłowe id!</div>' ?>
      </div>
      <div class="text-center mt-4 mb-4">
        <input class="btn btn-success" name='submit' type="submit" value="Zaloguj">
      </div>
      </form>
    </div>
  </div>

  <?php
  include('views/shared/footer.php');
  ?>

</body>

</html>