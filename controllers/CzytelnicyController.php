<?php

namespace controllers;

if(!isset($conn))
require "connect.php";
use \PDO;
use \PDOException;

class Czytelnicy
{
    public $czytelnicy_fillable = ['id_czytelnik','identyfikator','imie','nazwisko','email','pesel','nr_telefonu'];
}

class CzytelnicyController
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
                if ($option == 'czytelnicy') {
                    $czytelnik = new Czytelnicy();
                    foreach ($resultSet as $row) {
                        echo "<tr>";
                        foreach ($czytelnik->czytelnicy_fillable as $column) {
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

    public function create_select($option,$option1, $option2)
    {
        try {
            $conn = getConnection();
            if ($conn) {
                if ($option2 === 'autor') {
                    $sql = "INSERT INTO autorzy(imie, nazwisko) VALUES (:imie, :nazwisko)";
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