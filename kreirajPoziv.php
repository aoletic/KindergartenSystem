<?php
include 'Session/sesion_class.php';
include 'PHP Class/baza_class.php';
Sesija::kreirajSesiju();
$vrijeme = date('Y-m-d');
$vrijemednevnik=date('Y/m/d H:i:s');
$korisnik = $_SESSION["korisnik"];
$dbVeza = new Baza();
$dbVeza->spojiDB();
$sqlselect = "select * from korisnik where korisnicko_ime='{$korisnik}'";
$rezsql = $dbVeza->selectDB($sqlselect);
$row = mysqli_fetch_assoc($rezsql);
$idmoderatora = $row['korisnik_id'];

$sqlselectskupinamod = "select skupina.skupina_id from skupina left join vrtic on skupina.vrtic_vrtic_id=vrtic.vrtic_id where vrtic.korisnik_korisnik_id='{$idmoderatora}'";
$rezsqlskupinamod = $dbVeza->selectDB($sqlselectskupinamod);

 


if (isset($_POST['unesibutton'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $broj_mjesta = $_POST['broj_mjesta'];
    $datum_pocetka = $_POST['datum_pocetka'];
    $datum_zavrsetka = $_POST['datum_zavrsetka'];
    $skupina = $_POST['id_skupine'];
 while($row2 = mysqli_fetch_array($rezsqlskupinamod)){
     $red=$row2['skupina_id'];
     if($red==$skupina){
        $sqlunosospoziva = "insert into upisi(upisi_id, broj_mjesta, skupina_skupina_id, datum_od, datum_do, korisnik_korisnik_id) "
                . "VALUES (default, '{$broj_mjesta}', '{$skupina}', '{$datum_pocetka}', '{$datum_zavrsetka}', '{$idmoderatora}')";
        $rezsqlunospoziva = $dbVeza->updateDB($sqlunosospoziva);
        
          $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=13";
            $rezsqlTip = $dbVeza->selectDB($sqlTip);
            $rowTip = mysqli_fetch_assoc($rezsqlTip);
            $nazivTip = $rowTip['naziv_tipa'];

            $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                    . "VALUES (default, '{$nazivTip}', '{$vrijemednevnik}', '{$idmoderatora}',13)";
            $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);
        
        $dbVeza->zatvoriDB();
                }
            }
        }
        
    
    
    
if (isset($_POST['azuriraj'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $upisi_id=$_POST['id_poziva'];
    $broj_mjesta = $_POST['broj_mjesta'];
    $datum_pocetka = $_POST['datum_pocetka'];
    $datum_zavrsetka = $_POST['datum_zavrsetka'];
    $skupina = $_POST['id_skupine'];
    $sqlselectdatummod = "select * from upisi where upisi_id='{$upisi_id}'";
    $rezsqldatummod = $dbVeza->selectDB($sqlselectdatummod);
    $row3 = mysqli_fetch_assoc($rezsqldatummod);
    while($row2 = mysqli_fetch_array($rezsqlskupinamod)){
     $red=$row2['skupina_id'];
     if($red==$skupina){
        if($row3['datum_od']>$vrijeme){
        $sqlupdateoskupine = "update upisi set broj_mjesta='{$broj_mjesta}', datum_od='{$datum_pocetka}', "
        . "datum_do='{$datum_zavrsetka}', skupina_skupina_id='{$skupina}' where upisi_id='{$upisi_id}'";
        $rezsqlupdateskupine = $dbVeza->updateDB($sqlupdateoskupine);
        
          $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=26";
            $rezsqlTip = $dbVeza->selectDB($sqlTip);
            $rowTip = mysqli_fetch_assoc($rezsqlTip);
            $nazivTip = $rowTip['naziv_tipa'];

            $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                    . "VALUES (default, '{$nazivTip}', '{$vrijemednevnik}', '{$idmoderatora}',26)";
            $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);
        
        $dbVeza->zatvoriDB();
        }
    }
}
}
if (isset($_POST['izbrisi'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $upisi_id=$_POST['id_poziva'];
    $broj_mjesta = $_POST['broj_mjesta'];
    $datum_pocetka = $_POST['datum_pocetka'];
    $datum_zavrsetka = $_POST['datum_zavrsetka'];
    $skupina = $_POST['id_skupine'];
    $sqlselectdatummod = "select * from upisi where upisi_id='{$upisi_id}'";
    $rezsqldatummod = $dbVeza->selectDB($sqlselectdatummod);
    $row3 = mysqli_fetch_assoc($rezsqldatummod);
    while($row2 = mysqli_fetch_array($rezsqlskupinamod)){
     $red=$row2['skupina_id'];
     if($red==$skupina){
        if($row3['datum_od']>$vrijeme){
        $sqlbrisipoziv = "delete from upisi where upisi_id='{$upisi_id}'";
        $rezbrisipoziv = $dbVeza->updateDB($sqlbrisipoziv);
        
          $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=13";
            $rezsqlTip = $dbVeza->selectDB($sqlTip);
            $rowTip = mysqli_fetch_assoc($rezsqlTip);
            $nazivTip = $rowTip['naziv_tipa'];

            $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                    . "VALUES (default, '{$nazivTip}', '{$vrijemednevnik}', '{$idmoderatora}',27)";
            $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);
        
        $dbVeza->zatvoriDB();
    }
}
}
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Kreiraj pozive</title>
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
            <h1>KREIRAJ POZIVE</h1><br>
        </div>
        <div class="popis_vrtica" style= "transform: translate(10%, -25%);">
            <table id="popis_table8">
                <thead>
                    <tr>
                        <th>ID poziva</th>
                        <th>Broj mjesta</th>
                        <th>ID skupine</th>
                        <th>Datum početka</th>
                        <th>Datum završetka</th>
                        <th>ID moderatora</th>
                    </tr>
                </thead>
                <tbody id="tablica_pozivimod" for="popis_vrtica">
                    <?php
                    $dbVeza = new Baza();
                    $dbVeza->spojiDB();
                    $sqlPoziviMod = "SELECT * FROM upisi where upisi.korisnik_korisnik_id='{$idmoderatora}'";
                    $rezultatPoziviMod = $dbVeza->selectDB($sqlPoziviMod);
                    $dataRow = "";
                    while ($row = mysqli_fetch_array($rezultatPoziviMod)) {
                        $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";
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
                    <label for="id_vrtica"><b>ID poziva(prazno ako unosite novu)</b></label><br>
                    <input type="text" placeholder="Unesite ID poziva" name="id_poziva" id="id_poziva" style="height:47px ;font-size:20px"><br><br>
                    <label for="broj_mjesta"><b>Broj mjesta</b></label><br>
                    <input type="text" placeholder="Unesite broj mjesta" name="broj_mjesta" id="broj_mjesta"  style="height:47px ;font-size:20px"><br><br>
                    <label for="cijena_skupine"><b>ID skupine(samo skupinu kojoj ste moderator)</b></label><br>
                    <input type="text" placeholder="Unesite ID skupine" name="id_skupine" id="id_skupine"  style="height:47px ;font-size:20px"><br><br>
                    <label for="cijena_skupine"><b>Datum početka</b></label><br>
                    <input type="text" placeholder="Unesite datum početka" name="datum_pocetka" id="datum_pocetka"  style="height:47px ;font-size:20px"><br><br>
                    <label for="cijena_skupine"><b>Datum završetka</b></label><br>
                    <input type="text" placeholder="Unesite datum završetka" name="datum_zavrsetka" id="datum_zavrsetka"  style="height:47px ;font-size:20px"><br><br>


                    <input class="regbtn" type="submit" name="unesibutton" id="unesibutton" value="Unesi poziv">
                    <input class="regbtn" type="submit" name="azuriraj" id="azuriraj" value="Ažuriraj poziv">
                    <input class="regbtn" type="submit" name="izbrisi" id="izbrisi" value="Izbriši poziv"><br><br>
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
