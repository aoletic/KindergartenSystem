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
$idkorisnika = $row['korisnik_id'];
$dbVeza->zatvoriDB();


if (isset($_POST['unesibutton'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $ocjena = $_POST['ocjena'];
    $vrtic = $_POST['vrticcbox'];
    $sqlunosocjene = "insert into ocjena_vrtica(ocjena_vrtica_id, ocjena, ocjena_mjesec, vrtic_vrtic_id) "
            . "VALUES (default, '{$ocjena}', '{$vrijeme}', '{$vrtic}')";
    $rezsqlunosocjene = $dbVeza->selectDB($sqlunosocjene);

    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=3";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_assoc($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme2}', '{$idkorisnika}', 3)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

    $dbVeza->zatvoriDB();
}
if (isset($_POST['azuriraj'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $id_ocjene = $_POST['id_ocjene'];
    $ocjena = $_POST['ocjena'];
    $vrtic = $_POST['vrticcbox'];
    $sqlazurirajocjenu = "update ocjena_vrtica set ocjena='{$ocjena}', vrtic_vrtic_id='{$vrtic}', ocjena_mjesec='{$vrijeme}' where id_ocjene='{$id_ocjene}'";
    $rezsqlazurirajocjenu = $dbVeza->updateDB($sqlazurirajocjenu);

    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=22";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_assoc($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme2}', '{$idkorisnika}', 22)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

    $dbVeza->zatvoriDB();
}
if (isset($_POST['izbrisi'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $id_ocjene = $_POST['id_ocjene'];
    $sqlbrisiocjenu = "delete from ocjena_vrtica where ocjena_vrtica_id='{$id_ocjene}'";
    $rezbrisiocjenu = $dbVeza->updateDB($sqlbrisiocjenu);

    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=23";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_assoc($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme2}', '{$idkorisnika}', 23)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

    $dbVeza->zatvoriDB();
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Dodaj ocjenu</title>
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
            <h1>DODAJ OCJENU</h1><br>
        </div>
        <div class="popis_vrtica" style= "transform: translate(11%, -25%);">
            <table id="popis_table6">
                <thead>
                    <tr>
                        <th>ID ocjene</th>
                        <th>Ocjena</th>
                        <th>Datum ocjene</th>
                        <th>ID vrtića</th>
                    </tr>
                </thead>
                <tbody id="tablica_ocjene" for="popis_vrtica">

                </tbody>

            </table>
        </div>
        <div class="login_form">
            <form method="post" action="" id="forma_vrtic" >


                <div class="container">
                    <label for="id_vrtica"><b>ID ocjene(prazno ako unosite novu)</b></label><br>
                    <input type="text" placeholder="Unesite ID ocjene" name="id_ocjene" id="id_ocjene" style="height:47px ;font-size:20px"><br><br>
                    <label for="naziv_vrticavrtica"><b>Ocjena</b></label><br>
                    <input type="text" placeholder="Unesite ocjenu(1-10)" name="ocjena" id="ocjena"  style="height:47px ;font-size:20px"><br><br>
                    <label for="vrticcbox"><b>Vrtic</b></label><br>
                    <select name="vrticcbox" id="vrticcbox" style="height:47px;width:247px;font-size:20px;">
                    </select><br><br>

                    <input class="regbtn" type="submit" name="unesibutton" id="unesibutton" value="Unesi ocjenu">
                    <input class="regbtn" type="submit" name="azuriraj" id="azuriraj" value="Ažuriraj ocjenu">
                    <input class="regbtn" type="submit" name="izbrisi" id="izbrisi" value="Izbriši ocjenu"><br><br>
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
