<?php
/*// Informacje dotyczące połączenia z bazą danych Oracle
$host = 'adres_serwera'; // Adres serwera Oracle
$port = 'port'; // Port (np. 1521)
$sid = 'nazwa_bazy_danych'; // Nazwa bazy danych Oracle
$username = 'uzytkownik'; // Nazwa użytkownika
$password = 'haslo'; // Hasło użytkownika

// Tworzenie połączenia z bazą danych Oracle
$dsn = "oci:dbname=(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port)))(CONNECT_DATA=(SID=$sid)))";
$conn = new PDO($dsn, $username, $password);
*/


function getConnection() {
    $host = 'localhost';
    $port = '1521';
    $sid = 'xe'; // Zastąp 'SID' właściwym identyfikatorem systemu Oracle

    $username = 'C##HR'; // Zastąp 'username' właściwą nazwą użytkownika
    $password = 'root'; // Zastąp 'password' właściwym hasłem

    $conn = oci_connect($username, $password, "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))(CONNECT_DATA=(SID=$sid)))");

    if (!$conn) {
        $e = oci_error();
        echo "Błąd połączenia z bazą danych: " . $e['message'];
        return null;
    }
    return $conn;
}



?>