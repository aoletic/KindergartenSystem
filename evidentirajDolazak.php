<?php
include 'Session/sesion_class.php';
include 'PHP Class/baza_class.php';
Sesija::kreirajSesiju();
$vrijeme = date('Y/m/d');
    $vrijeme2 = date('Y/m/d H:i:s');
$korisnik = $_SESSION["korisnik"];
$dbVeza = new Baza();
$dbVeza->spojiDB();
$sqlselect = "select * from korisnik where korisnicko_ime='{$korisnik}'";
$rezsql = $dbVeza->selectDB($sqlselect);
$row = mysqli_fetch_assoc($rezsql);
$idmoderatora = $row['korisnik_id'];




if (isset($_POST['unesibutton'])) {
    $datum_dolaska = $_POST['datum_dolaska'];
    $iddjetetacbox = $_POST['iddjetetacbox'];
    $doslo = $_POST['doslo'];
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $sqlunesidolazak = "insert into dolasci (dolazak_id, datum_dolaska, doslo, dijete_dijete_id, korisnik_korisnik_id)"
            . "VALUES (default,  '{$datum_dolaska}', '{$doslo}',  '{$iddjetetacbox}', '{$idmoderatora}')";
    $rezsqlunesidolazak = $dbVeza->selectDB($sqlunesidolazak);

    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=7";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_assoc($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme2}', '{$idmoderatora}',7)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

    $dbVeza->zatvoriDB();
}

if (isset($_POST['kreirajracun'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $iddjetetacbox = $_POST['iddjetetacbox'];
    $datum_od = $_POST['datum_od'];
    $datum_do = $_POST['datum_do'];
    $sqlOduzmiNedolaske = "SELECT COUNT(doslo)*10 from dolasci where datum_dolaska>='{$datum_od}' and datum_dolaska<='{$datum_do}' and doslo='ne' and dijete_dijete_id='{$iddjetetacbox}'";
    $rezsqlOduzmiNedolaske = $dbVeza->selectDB($sqlOduzmiNedolaske);
    $row2 = mysqli_fetch_assoc($rezsqlOduzmiNedolaske);
    $razlika = $row2['COUNT(doslo)*10'];
    $sqlDobijCijenuSkupine = "SELECT skupina.cijena_skupine from skupina left join upisi on skupina.skupina_id=upisi.skupina_skupina_id left join prijave on "
            . "upisi.upisi_id=prijave.upisi_upisi_id left join dijete on prijave.prijave_id=dijete.prijave_prijave_id where dijete.dijete_id='{$iddjetetacbox}'";
    $rezsqlDobijCijenuSkupine = $dbVeza->selectDB($sqlDobijCijenuSkupine);
    $row3 = mysqli_fetch_assoc($rezsqlDobijCijenuSkupine);
    $cijenaSkupine = $row3['cijena_skupine'];
    $cijenaRacun = $cijenaSkupine - $razlika;
    $sqlDobijKorisnikaZaRacun = "SELECT prijave.korisnik_korisnik_id from prijave left join dijete on prijave.prijave_id=dijete.prijave_prijave_id where dijete.dijete_id='{$iddjetetacbox}'";
    $rezDobijKorisnikaZaRacun = $dbVeza->selectDB($sqlDobijKorisnikaZaRacun);
    $row4 = mysqli_fetch_assoc($rezDobijKorisnikaZaRacun);
    $korisnikZaRacun = $row4['korisnik_korisnik_id'];
    $sqlDobijVrtic = "SELECT vrtic_vrtic_id from dijete where dijete_id='{$iddjetetacbox}'";
    $rezsqlDobijVrtic = $dbVeza->selectDB($sqlDobijVrtic);
    $row5 = mysqli_fetch_assoc($rezsqlDobijVrtic);
    $VrticRacun = $row5['vrtic_vrtic_id'];

    $sqlKreirajRacun = "insert into racun (racun_id, datum_vrijeme, iznos, placen, vrtic_vrtic_id, korisnik_korisnik_id)"
            . "VALUES (default, '{$vrijeme2}', '{$cijenaRacun}', '0', '{$VrticRacun}', '{$korisnikZaRacun}')";
    $rezKreirajRacun = $dbVeza->updateDB($sqlKreirajRacun);

    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=25";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_assoc($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme2}', '{$idmoderatora}',25)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);
      $dbVeza->zatvoriDB();
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Evidentiraj dolaske</title>
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
            <h1>EVIDENTIRAJ DOLASKE</h1><br>
        </div>
        <div class="popis_vrtica" style= "transform: translate(5%, -10%);">
            <table id="popis_table10">
                <thead>
                    <tr>
                        <th>ID dolazak</th>
                        <th>Datum dolaska</th>
                        <th>Dijete došlo(da/ne)</th>
                        <th>ID djeteta</th>
                        <th>Ime djeteta</th>
                        <th>Prezime djeteta</th>
                        <th>ID moderatora</th>
                    </tr>
                </thead>
                <tbody id="tablica_dolascibody" for="popis_vrtica">
                    <?php
                    $dbVeza = new Baza();
                    $dbVeza->spojiDB();

                    $sqlDolasciMod = "select dolazak_id, datum_dolaska, doslo, dijete_dijete_id, dijete.ime_djeteta, dijete.prezime_djeteta, 
                            korisnik_korisnik_id from dolasci left join dijete on dolasci.dijete_dijete_id=dijete.dijete_id where korisnik_korisnik_id=$idmoderatora";
                    $rezultatDolasciMod = $dbVeza->selectDB($sqlDolasciMod);
                    $dataRow = "";
                    while ($row = mysqli_fetch_array($rezultatDolasciMod)) {
                        $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td></tr>";
                    }
                    echo $dataRow;
                    $dbVeza->zatvoriDB();
                    ?>
                </tbody>

            </table>
        </div>
        <div class="login_form" style= "transform: translate(5%, 25%);">
            <form method="post" action="" id="forma_vrtic" >

                <div class="container">
                    <label for="id_dolaska"><b>ID dolaska(prazno ako unosite novi)</b></label><br>
                    <input type="text" placeholder="Unesite ID dolaska" name="id_dolaska" id="id_dolaska" style="height:47px ;font-size:20px"><br><br>
                    <label for="datum_dolaska"><b>Datum dolaska(Y-M-D)</b></label><br>
                    <input type="text" placeholder="Unesite datum dolaska" name="datum_dolaska" id="datum_dolaska"  style="height:47px ;font-size:20px"><br><br>
                    <label for="doslo"><b>Doslo(da/ne)</b></label><br>
                    <input type="text" placeholder="Unesite da/ne" name="doslo" id="doslo"  style="height:47px ;font-size:20px"><br><br>
                    <label for="iddjetetacbox"><b>Dijete</b></label><br>
                    <select name="iddjetetacbox" id="iddjetetacbox" style="height:47px;width:247px;font-size:20px;">
                        <?php
                        $dbVeza = new Baza();
                        $dbVeza->spojiDB();
                        $sqlDjecaMod = "select dijete.dijete_id, dijete.ime_djeteta, dijete.prezime_djeteta from dijete "
                                . "left join vrtic on dijete.vrtic_vrtic_id=vrtic.vrtic_id where vrtic.korisnik_korisnik_id='{$idmoderatora}'";
                        $rezultatDjecaMod = $dbVeza->selectDB($sqlDjecaMod);
                        $dataRow = "";
                        while ($row = mysqli_fetch_array($rezultatDjecaMod)) {
                            $dataRow = $dataRow . "<option value=$row[0]>$row[1] $row[2]</option>";
                        }
                        echo $dataRow;
                        $dbVeza->zatvoriDB();
                        ?>
                    </select><br><br>
                    <label for="datum_od"><b>Datum od(samo za racun)Y-M-D</b></label><br>
                    <input type="text" placeholder="Unesite datum od" name="datum_od" id="datum_od"  style="height:47px ;font-size:20px"><br><br>
                    <label for="datum_do"><b>Datum do(samo za racun)Y-M-D</b></label><br>
                    <input type="text" placeholder="Unesite datum do" name="datum_do" id="datum_do"  style="height:47px ;font-size:20px"><br><br>

                    <input class="regbtn" type="submit" name="unesibutton" id="unesibutton" value="Unesi dolazak"><br><br>
                    <input class="regbtn" type="submit" name="kreirajracun" id="kreirajracun" value="Kreiraj račun">
                </div>

                <div class="container" style="background-color:#f1f1f1">


                </div>
                <div id="greske">  

                    <?php
                    if (isset($message)) {
                        echo"<p> $message</p>";
                    }
                    ?>

                </div>
            </form>

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
