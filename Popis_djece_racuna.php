<?php
include 'Session/sesion_class.php';
include 'PHP Class/baza_class.php';
Sesija::kreirajSesiju();
$vrijeme = date('Y/m/d H:i:s');
$korisnik = $_SESSION["korisnik"];
$dbVeza = new Baza();
$dbVeza->spojiDB();
$sqlselect = "select * from korisnik where korisnicko_ime='{$korisnik}'";
$rezsql = $dbVeza->selectDB($sqlselect);
$row = mysqli_fetch_assoc($rezsql);
$idmoderatora = $row['korisnik_id'];

$sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=9";
$rezsqlTip = $dbVeza->selectDB($sqlTip);
$rowTip = mysqli_fetch_assoc($rezsqlTip);
$nazivTip = $rowTip['naziv_tipa'];

$sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
        . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idmoderatora}',9";
$rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Popis broja djece i računa</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="aoletic">
        <meta name="descriptin" content="Početna stranica WebDiP projekta">
        <meta name="keywords" content="WebDiP, Projekt, Vrtić">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/aoletic.css" rel="stylesheet" type="text/css">
        <script src="javascript/aoletic_sidebar.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> 
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script> 
        <script type ="text/javascript" src="jquery/aoletic_jquery.js"></script>
    </head>




    <body id="sidebar_push" class="resetka" name="vrtici" onload="DobijVrtice()">
        <header class="zaglavje">
            <?php include './meni.php'; ?>

            <div id="main">
                <button class="openbtn" onclick="openNav()">&#9776; IZBORNIK</button>
            </div>

            <div class="header-form">
                <?php include './forma_search_odjava.php'; ?>
            </div>
        </header>

        <div class="naslov3">
            <h1>BROJ DJECE U VRTIĆIMA I RAČUNI</h1>
        </div>
        <div class="popis_vrtica"  style= "transform: translate(175%, -25%);width:40%;">
            <table id="popis_table4">
                <thead>
                    <tr>
                        <th>Naziv vrtića</th>
                        <th>Broj djece</th>

                    </tr>
                </thead>
                <tbody id="tablica_djece" for="popis_vrtica">

                </tbody>
            </table>
        </div>
        <div class="popis_vrtica"  style= "transform: translate(375%, -25%); width:40%;">
            <table id="popis_table5">
                <thead>
                    <tr>
                        <th>Naziv vrtića</th>
                        <th>Plaćeni računi</th>
                        <th>Neplaćeni računi</th>

                    </tr>
                </thead>
                <tbody id="tablica_racuna" for="popis_vrtica">

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
