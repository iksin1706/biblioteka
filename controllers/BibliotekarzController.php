<?php

namespace controllers;

if(!isset($conn))
require "connect.php";
use \PDO;
use \PDOException;

class Bibliotekarz
{
    public $bibliotekarz_fillable = ['id_bibliotekarz','imie','nazwisko','pesel','nr_telefonu'];
}

class BibliotekarzController
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
                if ($option == 'bibliotekarze') {
                    $bibliotekarz = new Bibliotekarz();
                    foreach ($resultSet as $row) {
                        echo "<tr>";
                        foreach ($bibliotekarz->bibliotekarz_fillable as $column) {
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
        $conn = getConnection();

        if ($conn) {
            try {
                if ($option2 === 'autor') {
                    $sql = "INSERT INTO autor(imię, nazwisko) VALUES (:imie, :nazwisko)";
                    $stmt = oci_parse($conn, $sql);
                    oci_bind_by_name($stmt, ':imie', $option);
                    oci_bind_by_name($stmt, ':nazwisko', $option1);
                } else {
                    $sql = "INSERT INTO $option2($option2) VALUES (:optionValue)";
                    $stmt = oci_parse($conn, $sql);
                    oci_bind_by_name($stmt, ':optionValue', $option);
                }
        
                oci_execute($stmt);
                
                oci_free_statement($stmt);
                oci_close($conn);
                
                header('Location: create.ksiazki.php');
                exit();
            } catch (PDOException $e) {
                echo "Wystąpił błąd przy dodawaniu do bazy danych: " . $e->getMessage();
            } finally {
                if ($conn) {
                    oci_close($conn);
                }
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