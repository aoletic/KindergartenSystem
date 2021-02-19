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
$idkorisnik= $row['korisnik_id'];


if (isset($_POST['unesibutton'])) {
    $id_racuna = $_POST['id_racuna'];
    $placen = $_POST['placen'];
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $sqlZakljucajKorisnika = "update racun set placen='{$placen}' where racun_id='{$id_racuna}'";
    $rezZakljucajKorisnika = $dbVeza->updateDB($sqlZakljucajKorisnika);
    $dbVeza->zatvoriDB();

}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Pregledaj račune</title>
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
            <h1>PREGLEDAJ RAČUNE</h1><br>
        </div>
        <div class="popis_vrtica" style= "transform: translate(20%, -25%);">
            <table id="popis_table14">
                <thead>
                    <tr>
                        <th>ID računa</th>
                        <th>Datum i vrijeme izdavanja</th>
                        <th>Iznos računa</th>
                        <th>Plaćen(0-ne/1-da)</th>
                        <th>Ime vrtića</th>
                    </tr>
                </thead>
                <tbody id="tablica_racunikor" for="popis_vrtica">
               
                    <?php
                     $dbVeza = new Baza();
                    $dbVeza->spojiDB();
                   
                    $sqlRacuniKor= "SELECT racun_id, datum_vrijeme, iznos, placen, vrtic.naziv_vrtica from racun "
                            . "left join vrtic on racun.vrtic_vrtic_id=vrtic.vrtic_id where racun.korisnik_korisnik_id='{$idkorisnik}'";
                    $rezultatRacuniKor= $dbVeza->selectDB($sqlRacuniKor);
                    $dataRow = "";
                    while ($row = mysqli_fetch_array($rezultatRacuniKor)) {
                        $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
                    }
                    
                    
                        $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=30";
                        $rezsqlTip = $dbVeza->selectDB($sqlTip);
                        $rowTip = mysqli_fetch_assoc($rezsqlTip);
                        $nazivTip = $rowTip['naziv_tipa'];

                        $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                                . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idkorisnik}', 30)";
                        $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);
                    
                    echo $dataRow;
                    $dbVeza->zatvoriDB();
                    ?>
                </tbody>

            </table>
        </div>
              <div class="login_form" style= "transform: translate(5%, 30%);"> 
            <form method="post" action="" id="forma_vrtic"  >


                <div class="container">
                   <label for="id_racuna"><b>ID računa</b></label><br>
                    <input type="text" placeholder="Unesite ID računa" name="id_racuna" id="id_racuna"  style="height:47px ;font-size:20px"><br><br>
                    <label for="placen"><b>Plačen(0-ne/1-da)</b></label><br>
                    <input type="text" placeholder="Plačen?" name="placen" id="placen"  style="height:47px ;font-size:20px"><br><br>

                    <input class="regbtn" type="submit" name="unesibutton" id="unesibutton" value="Podnesi"><br><br>

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
