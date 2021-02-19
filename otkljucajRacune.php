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

if (isset($_POST['zakljucaj'])) {
    $id_korisnika = $_POST['korisnikcbox'];
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $sqlZakljucajKorisnika = "update korisnik set pogreska_lozinka='3' where korisnik_id='{$id_korisnika}'";
    $rezZakljucajKorisnika = $dbVeza->updateDB($sqlZakljucajKorisnika);
  


    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=16";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_assoc($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idmoderatora}',16)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

    $message = "Uspješno ste zaključali korisnika!";
      $dbVeza->zatvoriDB();
}

if (isset($_POST['otkljucaj'])) {
    $id_korisnika = $_POST['korisnikcbox'];
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $sqlOtkljucajKorisnika = "update korisnik set pogreska_lozinka='0' where korisnik_id='{$id_korisnika}'";
    $rezOtkljucajKorisnika = $dbVeza->updateDB($sqlOtkljucajKorisnika);
    

    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=15";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_array($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$korisnik}',15)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

    $message = "Uspješno ste otključali korisnika!";
    
    $dbVeza->zatvoriDB();
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Otključaj/zaključaj račune</title>
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
            <h1>UPRAVLJAJ RAČUNIMA</h1><br>
        </div>
        <div class="popis_vrtica" style= "transform: translate(10%, -10%);">
            <table id="popis_table13">
                <thead>
                    <tr>
                        <th>ID korisnika</th>
                        <th>Korisničko ime</th>
                        <th>Broj krivih pokušaja</th>
                    </tr>
                </thead>
                <tbody id="tablica_dolascikor" for="popis_vrtica">
                      <?php
                    $dbVeza = new Baza();
                    $dbVeza->spojiDB();
                    $sqlDolasciMod = "SELECT korisnik_id, korisnicko_ime, pogreska_lozinka from korisnik where pogreska_lozinka>=3";
                    $rezultatDolasciMod = $dbVeza->selectDB($sqlDolasciMod);
                    $dataRow = "";
                    while ($row = mysqli_fetch_array($rezultatDolasciMod)) {
                        $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
                    }
                    echo $dataRow;                    
                    $dbVeza->zatvoriDB();
                    ?>
                </tbody>

            </table>
        </div>
        <div class="login_form" style= "transform: translate(5%, 30%);"> 
            <form method="post" action="" id="forma_vrtic"  >


                <div class="container">
                    <select name="korisnikcbox" id="korisnikcbox" style="height:47px;width:247px;font-size:20px;">
                    </select><br><br>
                    <input class="regbtn" type="submit" name="zakljucaj" id="zakljucaj" value="Zaključaj korisnika">
                    <input class="regbtn" type="submit" name="otkljucaj" id="otkljucaj" value="Otključaj korisnika">

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
