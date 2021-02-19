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
$idmoderatora = $row['korisnik_id'];



if (isset($_POST['unesibutton'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $naziv_skupine = $_POST['naziv_skupine'];
    $cijena_skupine = $_POST['cijena_skupine'];
    $vrtic = $_POST['vrticcbox'];

    $sqlunososkupine = "insert into skupina(skupina_id, naziv_skupine, cijena_skupine, vrtic_vrtic_id) "
            . "VALUES (default, '{$naziv_skupine}', '{$cijena_skupine}', '{$vrtic}')";
    $rezsqlunosskupine = $dbVeza->updateDB($sqlunososkupine);

    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=2";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_assoc($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idmoderatora}', 2)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

    $dbVeza->zatvoriDB();
}
if (isset($_POST['azuriraj'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $id_skupine = $_POST['id_skupine'];
    $naziv_skupine = $_POST['naziv_skupine'];
    $cijena_skupine = $_POST['cijena_skupine'];
    $vrtic = $_POST['vrticcbox'];

    $sqlupdateoskupine = "update skupina set naziv_skupine='{$naziv_skupine}', cijena_skupine='{$cijena_skupine}' where skupina_id='{$id_skupine}'";
    $rezsqlupdateskupine = $dbVeza->updateDB($sqlupdateoskupine);

    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=20";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_assoc($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idmoderatora}', 20)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

    $dbVeza->zatvoriDB();
}
if (isset($_POST['izbrisi'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $id_skupine = $_POST['id_skupine'];
    $vrtic = $_POST['vrticcbox'];

    $sqlbrisiskupinu = "delete from skupina where skupina_id='{$id_skupine}'";
    $rezbrisiskupinu = $dbVeza->updateDB($sqlbrisiskupinu);

    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=21";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_assoc($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idmoderatora}', 21)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

    $dbVeza->zatvoriDB();
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Kreiraj skupine</title>
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
            <h1>DODAJ SKUPINU</h1><br>
        </div>
        <div class="popis_vrtica" style= "transform: translate(10%, -25%);">
            <table id="popis_table7">
                <thead>
                    <tr>
                        <th>ID skupine</th>
                        <th>Naziv skupine</th>
                        <th>Cijena skupine</th>
                        <th>ID vrtića</th>
                    </tr>
                </thead>
                <tbody id="tablica_skupine" for="popis_vrtica">
<?php
$dbVeza = new Baza();
$dbVeza->spojiDB();
$sqlSkupineMod = "SELECT * FROM skupina left join vrtic on skupina.vrtic_vrtic_id=vrtic.vrtic_id";
$rezultatSkupineMod = $dbVeza->selectDB($sqlSkupineMod);
$dataRow = "";
while ($row = mysqli_fetch_array($rezultatSkupineMod)) {
    $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
}
echo $dataRow;
$dbVeza->zatvoriDB();
?>
                </tbody>

            </table>
        </div>
        <div class="login_form">
            <form method="post" action="" id="forma_vrtic" >

                <div class="container">
                    <label for="id_vrtica"><b>ID skupine(prazno ako unosite novu)</b></label><br>
                    <input type="text" placeholder="Unesite ID skupine" name="id_skupine" id="id_skupine" style="height:47px ;font-size:20px"><br><br>
                    <label for="naziv_skupine"><b>Naziv skupine</b></label><br>
                    <input type="text" placeholder="Unesite naziv skupine" name="naziv_skupine" id="naziv_skupine"  style="height:47px ;font-size:20px"><br><br>
                    <label for="cijena_skupine"><b>Cijena skupine</b></label><br>
                    <input type="text" placeholder="Unesite cijenu skupine" name="cijena_skupine" id="cijena_skupine"  style="height:47px ;font-size:20px"><br><br>
                    <label for="vrticcbox"><b>Vrtic</b></label><br>
                    <select name="vrticcbox" id="vrticcbox" style="height:47px;width:247px;font-size:20px;">
                    </select><br><br>

                    <input class="regbtn" type="submit" name="unesibutton" id="unesibutton" value="Unesi skupinu">
                    <input class="regbtn" type="submit" name="azuriraj" id="azuriraj" value="Ažuriraj skupinu">
                    <input class="regbtn" type="submit" name="izbrisi" id="izbrisi" value="Izbriši skupinu"><br><br>
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
