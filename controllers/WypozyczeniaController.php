<?php

namespace controllers;

if(!isset($conn))
require "connect.php";
use \PDO;
use \PDOException;

class Wypozyczenia
{
    public $wypozyczenia_fillable = ['id_wypozyczenie', 'bibliotekarz', 'czytelnik', 'id_ksiazka', 'data_wypozyczenia', 'data_zwrotu','czy_opoznione'];
}

class WypozyczeniaController
{

    public function show($option,$czytelnik)
    {
        $conn = getConnection();

        if ($conn) {
            if($czytelnik!='')
            $sql = "SELECT * FROM " . $option." WHERE czytelnik='".$czytelnik."' ORDER BY data_wypozyczenia DESC";
            else 
            $sql = "SELECT * FROM " . $option." ORDER BY data_wypozyczenia DESC";
            $stmt = oci_parse($conn, $sql);
            oci_execute($stmt);
        
            $resultSet = array();
            while ($row = oci_fetch_assoc($stmt)) {
                $resultSet[] = $row;
            }
        
            if (count($resultSet) === 0) {
                echo "Brak danych do wyświetlenia.";
            } else {
                    $wypozyczenia = new Wypozyczenia();
                    foreach ($resultSet as $row) {
                        $id = $row['ID_WYPOZYCZENIE'];;
                        echo "<tr>";
                        foreach ($wypozyczenia->wypozyczenia_fillable as $column) {
                            echo "<td>" . $row[strtoupper($column)] . "</td>";
                        }
                        if(!$row['DATA_ZWROTU'])
                        echo '<td><a href="wypozyczenia.php?zwrot='.$id.'" type="button" class="btn btn-primary">Przyjmij zwrot</a></td>';
                        else echo '<td></td>';
                        echo "</tr>";
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