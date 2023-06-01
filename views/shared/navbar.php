<nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="#">Biblioteka</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage === 'start') ? 'active' : ''; ?>" href="../../start.php">Start</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage === 'wypozyczenia') ? 'active' : ''; ?>" href="../wypozyczenia/wypozyczenia.php">Wypożyczenia</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage === 'czytelnicy') ? 'active' : ''; ?>" href="../czytelnicy/czytelnicy.php">Czytelnicy</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage === 'ksiazki') ? 'active' : ''; ?>" href="../ksiazki/ksiazki.php">Książki</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage === 'bibliotekarz') ? 'active' : ''; ?>" href="../bibliotekarz/bibliotekarz.php">Bibliotekarz</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage === 'statystyki') ? 'active' : ''; ?>" href="../statystyki/statystyki.php">Statystyki</a>
              </li>
            </ul>

          </div>
        </div>
      </nav>