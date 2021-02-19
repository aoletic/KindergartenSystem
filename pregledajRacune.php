<?php
include 'Session/sesion_class.php';
include 'PHP Class/baza_class.php';
Sesija::kreirajSesiju();
error_reporting(0);
$vrijeme = date('Y/m/d H:i:s');
$korisnik = $_SESSION["korisnik"];
$dbVeza = new Baza();
$dbVeza->spojiDB();
$sqlselect = "select * from korisnik where korisnicko_ime='{$korisnik}'";
$rezsql = $dbVeza->selectDB($sqlselect);
$row = mysqli_fetch_assoc($rezsql);
$idmoderatora = $row['korisnik_id'];
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
        <div class="popis_vrtica" style= "transform: translate(5%, -10%);">
            <table id="popis_table11">
                <thead>
                    <tr>
                        <th>ID račun</th>
                        <th>Datum kreiranja računa</th>
                        <th>Iznos računa</th>
                        <th>Plačen(0-ne/1-da)</th>
                        <th>Id vrtića</th>
                        <th>Ime primatelja računa</th>
                        <th>Prezime primatelja računa</th>
                    </tr>
                </thead>
                <tbody id="tablica_racunabody" for="popis_vrtica">
                    <?php
                    $dbVeza = new Baza();
                    $dbVeza->spojiDB();
                    $datum_od = $_POST['datum_od'];
                    $datum_do = $_POST['datum_do'];
                    $vrtic = $_POST['vrticcboxmod'];
                    $sqlDolasciMod = "SELECT racun_id, datum_vrijeme, iznos, placen, vrtic_vrtic_id, korisnik.ime, korisnik.prezime from racun left join korisnik on "
                            . "racun.korisnik_korisnik_id=korisnik.korisnik_id where datum_vrijeme>='{$datum_od}' and datum_vrijeme<='{$datum_do}' "
                            . "and racun.vrtic_vrtic_id='{$vrtic}'";
                    $rezultatDolasciMod = $dbVeza->selectDB($sqlDolasciMod);
                    $dataRow = "";
                    while ($row = mysqli_fetch_array($rezultatDolasciMod)) {
                        $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td></tr>";
                    }
                    echo $dataRow;
                    
                    
                        $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=30";
                        $rezsqlTip = $dbVeza->selectDB($sqlTip);
                        $rowTip = mysqli_fetch_assoc($rezsqlTip);
                        $nazivTip = $rowTip['naziv_tipa'];

                        $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                                . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idmoderatora}', 30)";
                        $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);
                    
                    $dbVeza->zatvoriDB();
                    ?>
                </tbody>

            </table>
        </div>
        <div class="login_form" style= "transform: translate(5%, 5%);">
            <form method="post" action="" id="forma_vrtic" >

                <div class="container">
                    <label for="vrticcboxmod"><b>Vrtić</b></label><br>
                    <select name="vrticcboxmod" id="vrticcboxmod" style="height:47px;width:247px;font-size:20px;">
                        <?php
                        $dbVeza = new Baza();
                        $dbVeza->spojiDB();
                        $sqlVrticMod = "select vrtic_id, naziv_vrtica from vrtic where korisnik_korisnik_id='{$idmoderatora}'";
                        $rezultatVrticMod = $dbVeza->selectDB($sqlVrticMod);
                        $dataRow = "";
                        while ($row = mysqli_fetch_array($rezultatVrticMod)) {
                            $dataRow = $dataRow . "<option value=$row[0]>$row[1]</option>";
                        }
                        echo $dataRow;

                        $dbVeza->zatvoriDB();
                        ?>
                    </select><br><br>
                    <label for="datum_od"><b>Datum od(Y-M-D)</b></label><br>
                    <input type="text" placeholder="Unesite datum od" name="datum_od" id="datum_od"  style="height:47px ;font-size:20px"><br><br>
                    <label for="datum_do"><b>Datum do(Y-M-D)</b></label><br>
                    <input type="text" placeholder="Unesite datum do" name="datum_do" id="datum_do"  style="height:47px ;font-size:20px"><br><br>

                    <input class="regbtn" type="submit" name="unesibutton" id="unesibutton" value="Prikaži račune"><br><br>
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
