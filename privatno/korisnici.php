<?php

include '../PHP Class/baza_class.php';
$dbVeza = new Baza();
$dbVeza->spojiDB();

$sql = "SELECT * FROM korisnik;";
$res = $dbVeza->selectDB($sql);
while ($red = $res->fetch_assoc()) {
    echo "Korisnik: {$red["ime"]}, {$red["prezime"]}, {$red["korisnicko_ime"]}, {$red["email"]}, {$red["lozinka"]}<br>";
}
$dbVeza->zatvoriDB();
