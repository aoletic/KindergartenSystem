<?php
error_reporting(0);
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

$sqlselectskupinamod = "select skupina.skupina_id from skupina left join vrtic on skupina.vrtic_vrtic_id=vrtic.vrtic_id where vrtic.korisnik_korisnik_id='{$idmoderatora}'";
$rezsqlskupinamod = $dbVeza->selectDB($sqlselectskupinamod);
$id_upisi = $_POST['upisicbox'];
$sqlbrojmjesta = "select broj_mjesta from upisi where upisi_id=$id_upisi";
$rezsqlbrojmjesta = $dbVeza->selectDB($sqlbrojmjesta);
$row4 = mysqli_fetch_assoc($rezsqlbrojmjesta);
$brojmjesta = $row4['broj_mjesta'];


if (isset($_POST['prihvatiprijave'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $sqlprihvatiprijave = "update prijave set prihvacen='da' where upisi_upisi_id=$id_upisi order by prijave_id LIMIT $brojmjesta";
    $rezsqlprihvatiprijave = $dbVeza->updateDB($sqlprihvatiprijave);

    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=24";
    $rezsqlTip = $dbVeza->selectDB($sqlTip);
    $rowTip = mysqli_fetch_assoc($rezsqlTip);
    $nazivTip = $rowTip['naziv_tipa'];

    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idmoderatora}', 24)";
    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

    $dbVeza->zatvoriDB();
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Pregledaj prijave</title>
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
            <h1>PREGLEDAJ PRIJAVE</h1><br>
        </div>
        <div class="popis_vrtica" style= "transform: translate(10%, -25%);">
            <table id="popis_table9">
                <thead>
                    <tr>
                        <th>ID prijave</th>
                        <th>ID upisa</th>
                        <th>ID korisnika koji se je prijavio</th>
                        <th>Prihvaćen</th>
                        <th>Upisan</th>
                    </tr>
                </thead>
                <tbody id="tablica_prijavemod" for="popis_vrtica">
                    <?php
                    $dbVeza = new Baza();
                    $dbVeza->spojiDB();

                    $sqlPrijaveMod = "select * from prijave where upisi_upisi_id=$id_upisi";
                    $rezultatPrijaveMod = $dbVeza->selectDB($sqlPrijaveMod);
                    $dataRow = "";
                    while ($row = mysqli_fetch_array($rezultatPrijaveMod)) {
                        $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
                    }
                    echo $dataRow;

                    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=5";
                    $rezsqlTip = $dbVeza->selectDB($sqlTip);
                    $rowTip = mysqli_fetch_assoc($rezsqlTip);
                    $nazivTip = $rowTip['naziv_tipa'];

                    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idmoderatora}', 5)";
                    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

                    $dbVeza->zatvoriDB();
                    ?>
                </tbody>

            </table>
        </div>
        <div class="login_form">
            <form method="post" action="" id="forma_vrtic" >

                <div class="container">
                    <select name="upisicbox" id="upisicbox" style="height:47px;width:247px;font-size:20px;">
                        <?php
                        $dbVeza = new Baza();
                        $dbVeza->spojiDB();
                        $sqlUpisimod = "SELECT upisi_id FROM upisi where korisnik_korisnik_id='{$idmoderatora}'";
                        $rezultatUpisiMod = $dbVeza->selectDB($sqlUpisimod);
                        $dataRow = "";
                        while ($row = mysqli_fetch_array($rezultatUpisiMod)) {
                            $dataRow = $dataRow . "<option>$row[0]</option>";
                        }
                        echo $dataRow;
                        $dbVeza->zatvoriDB();
                        ?>
                    </select><br><br>
                    <input class="regbtn" type="submit" name="prikaziprijave" id="prikaziprijave" value="Prikaži prijave">
                    <input class="regbtn" type="submit" name="prihvatiprijave" id="prihvatiprijave" value="Prihvati prijave">

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
