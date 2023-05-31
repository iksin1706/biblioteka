<?php

namespace controllers;

require "connect.php";

use \PDO;
use \PDOException;

class Ksiazka
{
    public $ksiazka_fillable = ['id_ksiazka', 'autor', 'gatunek', 'wydawnictwo', 'tytul', 'rok'];
}

class Gatunek
{
    public $gatunek_fillable = ['id_gatunek', 'gatunek'];
}

class Wydawnictwo
{
    public $wydawnictwo_fillable = ['id_wydawnictwo', 'wydawnictwo'];
}

class Autor
{
    public $autor_fillable = ['id_autor', 'imie', 'nazwisko'];
}

class KsiazkiController
{

    public function show($option)
    {
        $conn = getConnection();

        if ($conn) {
            $sql = "SELECT * FROM " . $option;
            $stmt = oci_parse($conn, $sql);
            oci_execute($stmt);

            $resultSet = array();
            while ($row = oci_fetch_assoc($stmt)) {
                $resultSet[] = $row;
            }

            if (count($resultSet) === 0) {
                echo "Brak danych do wyświetlenia.";
            } else {
                if ($option == 'dostepne_ksiazki') {
                    $ksiazka = new Ksiazka();
                    foreach ($resultSet as $row) {
                        echo "<tr>";
                        foreach ($ksiazka->ksiazka_fillable as $column) {
                            echo "<td>" . $row[strtoupper($column)] . "</td>";
                        }
                        echo '<td><center><button type="button" class="btn btn-outline-dark">Edytuj</button></center></td>';
                        echo "</tr>";
                    }
                }

                if ($option == 'wydawnictwa') {
                    $wydawnictwo = new Wydawnictwo();
                    foreach ($resultSet as $row) {
                        echo "<tr>";
                        foreach ($wydawnictwo->wydawnictwo_fillable as $column) {
                            echo "<td>" . $row[strtoupper($column)] . "</td>";
                        }
                        echo '<td><center><button type="button" class="btn btn-outline-dark">Edytuj</button></center></td>';
                        echo "</tr>";
                    }
                }

                if ($option == 'gatunki') {
                    $gatunek = new Gatunek();
                    foreach ($resultSet as $row) {
                        echo "<tr>";
                        foreach ($gatunek->gatunek_fillable as $column) {
                            echo "<td>" . $row[strtoupper($column)] . "</td>";
                        }
                        echo '<td><center><button type="button" class="btn btn-outline-dark">Edytuj</button></center></td>';
                        echo "</tr>";
                    }
                }

                if ($option == 'autorzy') {
                    $autor = new Autor();
                    foreach ($resultSet as $row) {
                        echo "<tr>";
                        foreach ($autor->autor_fillable as $column) {
                            echo "<td>" . $row[strtoupper($column)] . "</td>";
                        }
                        echo '<td><center><button type="button" class="btn btn-outline-dark">Edytuj</button></center></td>';
                        echo "</tr>";
                    }
                }
            }

            oci_free_statement($stmt);
            oci_close($conn);
        }
    }

    public function show_select($option)
    {
        $conn = getConnection();

        if ($conn) {
            if ($option == 'autorzy') {
                $sql = "SELECT imię, nazwisko FROM " . $option . " ORDER BY imię";
            } else {
                $sql = "SELECT " . $option . " FROM " . $option . " ORDER BY " . $option;
            }
        
            $stmt = oci_parse($conn, $sql);
            oci_execute($stmt);
        
            $resultSet = array();
            while ($row = oci_fetch_assoc($stmt)) {
                $resultSet[] = $row;
            }
        
            if (count($resultSet) === 0) {
                echo "Brak danych do wyświetlenia.";
            } else {
                foreach ($resultSet as $row) {
                    if ($option == 'autor') {
                        echo "<option>" . $row['IMIĘ'] . " " . $row['NAZWISKO'] . "</option>";
                    } else {
                        echo "<option>" . $row[strtoupper($option)] . "</option>";
                    }
                }
            }
        
            oci_free_statement($stmt);
            oci_close($conn);
        }
        
    }


    public function create_select($option, $option1, $option2)
    {
        try {
            $conn = getConnection();
            if ($conn) {
                if ($option2 === 'autor') {
                    $sql = "INSERT INTO autor(imię, nazwisko) VALUES (:imie, :nazwisko)";
                    $stmt = oci_parse($conn, $sql);
                    oci_bind_by_name($stmt, ':imie', $option);
                    oci_bind_by_name($stmt, ':nazwisko', $option1);
                    oci_execute($stmt);
                } else {
                    $sql = "INSERT INTO $option2($option2) VALUES (:optionValue)";
                    $stmt = oci_parse($conn, $sql);
                    oci_bind_by_name($stmt, ':optionValue', $option);
                    oci_execute($stmt);
                }
        
                header('Location: create.ksiazki.php');
                exit();
            }
        } catch (PDOException $e) {
            echo "Wystąpił błąd przy dodawaniu do bazy danych: " . $e->getMessage();
        } finally {
            if ($conn) {
                oci_close($conn);
            }
        }
    }

    public function index()
    {
    }

    public function create()
    {

        $conn = getConnection();
    }

    public function store()
    {
    }


    public function edit()
    {
    }


    public function update()
    {
    }


    public function destroy()
    {
    }
}
