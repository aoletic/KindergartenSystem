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
$idkorisnika = $row['korisnik_id'];

if (isset($_POST['prijavi'])) {
    $naziv_skupine = $_POST['skupinacbox'];
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $sqlUpisiID = "SELECT upisi_id from upisi where skupina_skupina_id='{$naziv_skupine}' and datum_od<='{$vrijeme}' and datum_do>='{$vrijeme}'";
    $rezUpisiID = $dbVeza->selectDB($sqlUpisiID);
    if ($rezUpisiID->num_rows > 0) {
        while ($row2 = $rezUpisiID->fetch_assoc()) {
            $upisiID = $row2['upisi_id'];
            $sqlPrijaviDijete = "insert into prijave (prijave_id, upisi_upisi_id, korisnik_korisnik_id, prihvacen, upisan)"
                    . "VALUES(default, '{$upisiID}', '{$idkorisnika}', 'ne', 'ne')";
            $rezPrijaviDIjete = $dbVeza->updateDB($sqlPrijaviDijete);

            $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=4";
            $rezsqlTip = $dbVeza->selectDB($sqlTip);
            $rowTip = mysqli_fetch_assoc($rezsqlTip);
            $nazivTip = $rowTip['naziv_tipa'];

            $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                    . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idkorisnika}', 4)";
            $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);
        }
        $dbVeza->zatvoriDB();
        $message = "Uspješno ste prijavili dijete!";
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Prijavi dijete</title>
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


    <body id="sidebar_push" class="resetka" name="vrtici" onload="DobijPozive()">
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
            <h1>PRIJAVI DIJETE</h1><br>
        </div>

        <div class="popis_poziva">
            <table id="popis_table2">
                <thead>
                    <tr>
                        <th>Datum početka poziva</th>
                        <th>Datum završetka poziva</th>
                        <th>Broj mjesta skupine</th>
                        <th>Naziv skupine</th>
                        <th>Naziv vrtića</th>
                        <th>Ime kreatora poziva</th>
                        <th>Prezime kreatora poziva</th>
                    </tr>
                </thead>
                <tbody id="tablica_pozivabody" for="popis_table2">

                </tbody>
            </table>
        </div>
        <div class="login_form" style= "transform: translate(-5%, 30%)">
            <form method="post" action="" id="forma_vrtic" >


                <div class="container" >
                    <label for="skupinacbox"><b>Odaberite skupinu u koju želite prijaviti dijete:</b></label><br>
                    <select name="skupinacbox" id="skupinacbox" style="height:47px;width:247px;font-size:20px;">
                    </select><br><br>

                    <input class="regbtn" type="submit" name="prijavi" id="prijavi" value="Prijavi dijete u skupinu">


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
