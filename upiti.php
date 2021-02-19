<?php

include 'PHP Class/baza_class.php';

if (isset($_GET["dohvatiPozive"])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();

    $polje = [];
    $sqlJavniPozivi = "SELECT upisi.datum_od, upisi.datum_do, upisi.broj_mjesta, skupina.naziv_skupine, vrtic.naziv_vrtica, korisnik.ime, korisnik.prezime from upisi "
            . "join skupina on upisi.skupina_skupina_id=skupina.skupina_id "
            . "join vrtic on skupina.vrtic_vrtic_id=vrtic.vrtic_id join korisnik on korisnik.korisnik_id=upisi.korisnik_korisnik_id";
    $rezultatJavniPozivi = $dbVeza->selectDB($sqlJavniPozivi);
    if ($rezultatJavniPozivi->num_rows > 0) {
        while ($row = $rezultatJavniPozivi->fetch_assoc()) {
            $response['datum_od'] = $row['datum_od'];
            $response['datum_do'] = $row['datum_do'];
            $response['broj_mjesta'] = $row['broj_mjesta'];
            $response['naziv_skupine'] = $row['naziv_skupine'];
            $response['naziv_vrtica'] = $row['naziv_vrtica'];
            $response['ime'] = $row['ime'];
            $response['prezime'] = $row['prezime'];
            $polje[] = $response;
        }
        echo json_encode($polje);
    }
    $dbVeza->zatvoriDB();
}

if (isset($_GET["dohvatiVrtice"])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();

    $polje = [];
    $sqlDjecjiVrtici = "SELECT k.naziv_vrtica, k.adresa_vrtica, AVG(kg.ocjena) as ocjena FROM vrtic k LEFT JOIN ocjena_vrtica kg ON k.vrtic_id = kg.vrtic_vrtic_id "
            . "WHERE kg.ocjena_mjesec >= (SELECT kg2.ocjena_mjesec FROM ocjena_vrtica kg2 WHERE kg2.vrtic_vrtic_id = kg.vrtic_vrtic_id"
            . " ORDER BY kg2.ocjena_mjesec DESC LIMIT 1 OFFSET 2 ) GROUP BY k.naziv_vrtica";
    $rezultatDjecjiVrtici = $dbVeza->selectDB($sqlDjecjiVrtici);
    if ($rezultatDjecjiVrtici->num_rows > 0) {
        while ($row = $rezultatDjecjiVrtici->fetch_assoc()) {
            $response['naziv_vrtica'] = $row['naziv_vrtica'];
            $response['adresa_vrtica'] = $row['adresa_vrtica'];
            $response['ocjena'] = $row['ocjena'];

            $polje[] = $response;
        }
        echo json_encode($polje);
    }
    $dbVeza->zatvoriDB();
}

if (isset($_GET["dohvatiVrticeAdmin"])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();

    $polje = [];
    $sqlDjecjiVrticiAdmin = "SELECT * from vrtic";
    $rezultatDjecjiVrticiAdmin = $dbVeza->selectDB($sqlDjecjiVrticiAdmin);
    if ($rezultatDjecjiVrticiAdmin->num_rows > 0) {
        while ($row = $rezultatDjecjiVrticiAdmin->fetch_assoc()) {
            $response['vrtic_id'] = $row['vrtic_id'];
            $response['naziv_vrtica'] = $row['naziv_vrtica'];
            $response['adresa_vrtica'] = $row['adresa_vrtica'];
            $response['korisnik_korisnik_id'] = $row['korisnik_korisnik_id'];

            $polje[] = $response;
        }
        echo json_encode($polje);
    }
    $dbVeza->zatvoriDB();
}



if (isset($_GET["dohvatiKorisnickaImena"])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $polje = [];
    $sqlKorisnickoIme = "SELECT korisnicko_ime from korisnik";
    $rezultatKorisnickoIme = $dbVeza->selectDB($sqlKorisnickoIme);
    if ($rezultatKorisnickoIme->num_rows > 0) {
        while ($row = $rezultatKorisnickoIme->fetch_assoc()) {
            $response['korisnicko_ime'] = $row['korisnicko_ime'];
            $polje[] = $response;
        }
        echo json_encode($polje);
    }

    $dbVeza->zatvoriDB();
}

if (isset($_GET["dohvatiKorisnickaImenaCbox"])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $polje = [];
    $sqlKorisnickoIme = "SELECT korisnik_id, korisnicko_ime from korisnik";
    $rezultatKorisnickoIme = $dbVeza->selectDB($sqlKorisnickoIme);
    if ($rezultatKorisnickoIme->num_rows > 0) {
        while ($row = $rezultatKorisnickoIme->fetch_assoc()) {
            $response['korisnik_id'] = $row['korisnik_id'];
            $response['korisnicko_ime'] = $row['korisnicko_ime'];

            $polje[] = $response;
        }
        echo json_encode($polje);
    }

    $dbVeza->zatvoriDB();
}

if (isset($_GET["dohvatiBrojDjece"])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $polje = [];

    $sqlBrojDjece = "SELECT naziv_vrtica, SUM(broj_mjesta) as broj from upisi right join skupina on skupina_skupina_id=skupina.skupina_id "
            . "right join vrtic on skupina.vrtic_vrtic_id=vrtic.vrtic_id group by naziv_vrtica order by naziv_vrtica desc;";
    $rezultatBrojDjece = $dbVeza->selectDB($sqlBrojDjece);

    if ($rezultatBrojDjece->num_rows > 0) {
        while ($row = $rezultatBrojDjece->fetch_assoc()) {
            $response['naziv_vrtica'] = $row['naziv_vrtica'];
            $response['broj'] = $row['broj'];

            $polje[] = $response;
        }
        echo json_encode($polje);
    }

    $dbVeza->zatvoriDB();
}

if (isset($_GET["dohvatiRacune"])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $polje2 = [];
    $sqlRacuni = "SELECT naziv_vrtica, SUM(case when placen = 0 THEN 1 ELSE 0 END) as neplaceni, SUM(case when placen > 0 THEN 1 ELSE 0 END)  "
            . "as placeni from racun right join vrtic on vrtic_vrtic_id=vrtic.vrtic_id group by naziv_vrtica order by naziv_vrtica desc;";
    $rezultatRacuni = $dbVeza->selectDB($sqlRacuni);
    if ($rezultatRacuni->num_rows > 0) {
        while ($row2 = $rezultatRacuni->fetch_assoc()) {
            $response2['naziv_vrtica'] = $row2['naziv_vrtica'];
            $response2['neplaceni'] = $row2['neplaceni'];
            $response2['placeni'] = $row2['placeni'];


            $polje2[] = $response2;
        }
        echo json_encode($polje2);
    }
    $dbVeza->zatvoriDB();
}

if (isset($_GET["dohvatiOcjene"])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $polje2 = [];
    $sqlOcjene = "SELECT * from ocjena_vrtica";
    $rezultatOcjene = $dbVeza->selectDB($sqlOcjene);
    if ($rezultatOcjene->num_rows > 0) {
        while ($row = $rezultatOcjene->fetch_assoc()) {
            $response['ocjena_vrtica_id'] = $row['ocjena_vrtica_id'];
            $response['ocjena'] = $row['ocjena'];
            $response['ocjena_mjesec'] = $row['ocjena_mjesec'];
            $response['vrtic_vrtic_id'] = $row['vrtic_vrtic_id'];


            $polje[] = $response;
        }
        echo json_encode($polje);
    }
    $dbVeza->zatvoriDB();
}

if (isset($_GET["dohvatiSkupine"])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $polje2 = [];
    $sqlSkupine = "SELECT skupina_id, naziv_skupine from skupina";
    $rezultatSkupine = $dbVeza->selectDB($sqlSkupine);
    if ($rezultatSkupine->num_rows > 0) {
        while ($row = $rezultatSkupine->fetch_assoc()) {
            $response['skupina_id'] = $row['skupina_id'];
            $response['naziv_skupine'] = $row['naziv_skupine'];

            $polje[] = $response;
        }
        echo json_encode($polje);
    }
    $dbVeza->zatvoriDB();
}

if (isset($_GET["DobijSliku"])) {
    $naziv = $_GET['naziv_vrtica'];
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $polje2 = [];
    $sqlSlike = "SELECT ime_djeteta, prezime_djeteta, slika_djeteta from dijete left join vrtic on vrtic_vrtic_id=vrtic.vrtic_id where vritc.naziv_vrtica='{$naziv}'";
    $rezultatSlike = $dbVeza->selectDB($sqlSlike);
    if ($rezultatSlike->num_rows > 0) {
        while ($row = $rezultatSlike->fetch_assoc()) {
            $response['ime_djeteta'] = $row['ime_djeteta'];
            $response['prezime_djeteta'] = $row['prezime_djeteta'];
            $response['slika_djeteta'] = $row['slika_djeteta'];

            $polje[] = $response;
        }
        echo json_encode($polje);
    }
    $dbVeza->zatvoriDB();
}
?>