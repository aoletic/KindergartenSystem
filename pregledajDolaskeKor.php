<?php
include 'Session/sesion_class.php';
include 'PHP Class/baza_class.php';
Sesija::kreirajSesiju();
$vrijeme = date('Y-m-d');
$korisnik = $_SESSION["korisnik"];
$dbVeza = new Baza();
$dbVeza->spojiDB();
$sqlselect = "select * from korisnik where korisnicko_ime='{$korisnik}'";
$rezsql = $dbVeza->selectDB($sqlselect);
$row = mysqli_fetch_assoc($rezsql);
$idkorisnik= $row['korisnik_id'];

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Pregledaj dolaske</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="aoletic">
        <meta name="descriptin" content="Početna stranica WebDiP projekta">
        <meta name="keywords" content="WebDiP, Projekt, Vrtić">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/aoletic.css" rel="stylesheet" type="text/css">
        <link href="css/aoletic_upravljajvrticima.css" rel="stylesheet" type="text/css">  
        <script src="javascript/aoletic_sidebar.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> 
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script> 
        <script type ="text/javascript" src="jquery/aoletic_jquery.js"></script>
    </head>




    <body id="sidebar_push" class="resetka" name="vrtici" onload="DobijVrticeAdmin()">
        <header class="zaglavje">
            <?php include './meni.php'; ?>

            <div id="main">
                <button class="openbtn" onclick="openNav()">&#9776; IZBORNIK</button>
            </div>

            <div class="header-form">
                <?php include './forma_search_odjava.php'; ?>
            </div>
        </header>

        <div class="naslov">
            <h1>PREGLEDAJ DOLASKE</h1><br>
        </div>
        <div class="popis_vrtica" style= "transform: translate(20%, -25%);">
            <table id="popis_table13">
                <thead>
                    <tr>
                        <th>Datum dolaska</th>
                        <th>Dolazak(da/ne)</th>
                        <th>Ime djeteta</th>
                        <th>Prezime djeteta</th>
                    </tr>
                </thead>
                <tbody id="tablica_dolascikor" for="popis_vrtica">
                    <?php
                     $dbVeza = new Baza();
                    $dbVeza->spojiDB();
                   
                    $sqlDolasciKor = "SELECT dolasci.datum_dolaska, dolasci.doslo, dijete.ime_djeteta, dijete.prezime_djeteta "
                            . "from dolasci left join dijete on dolasci.dijete_dijete_id=dijete.dijete_id "
                            . "left join prijave on dijete.prijave_prijave_id=prijave.prijave_id where prijave.korisnik_korisnik_id='{$idkorisnik}'";
                    $rezultatDolasciKor = $dbVeza->selectDB($sqlDolasciKor);
                    $dataRow = "";
                    while ($row = mysqli_fetch_array($rezultatDolasciKor)) {
                        $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
                    }
                    echo $dataRow;
                    $dbVeza->zatvoriDB();
                    ?>
                </tbody>

            </table>
        </div>

        <footer class="podnozje" id="podnozje_push">
            <address>
                Kontakt:
                <a href="mailto:aoletic@foi.hr" style="color:white">Antonio Oletić</a>
                <p>&copy; 2020</p>
            </address>
        </footer>
    </body>


</html>
