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
$dbVeza->zatvoriDB();

 
   if (isset($_POST['unesibutton'])) {
       $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $naziv_vrtica = $_POST['naziv_vrtica'];
    $adresa_vrtica = $_POST['adresa_vrtica'];
    $sqlunosvrtica="insert into vrtic(vrtic_id, naziv_vrtica, adresa_vrtica, korisnik_korisnik_id) "
            . "VALUES (default, '{$naziv_vrtica}', '{$adresa_vrtica}', NULL)";
    $rezsqlunosvrtica=$dbVeza->selectDB($sqlunosvrtica);
     $sqlTip="select tip_id ,naziv_tipa from tip where tip_id=1";
    $rezsqlTip=$dbVeza->selectDB($sqlTip);
    $rowTip= mysqli_fetch_assoc($rezsqlTip);
    $nazivTip=$rowTip['naziv_tipa'];
    
    $sqlDnevnikInsert="insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idkorisnika}', 1)";
    $rezsqlDnevniKInstert=$dbVeza->selectDB($sqlDnevnikInsert);
     $dbVeza->zatvoriDB();
       
   }
     if (isset($_POST['azuriraj'])) {
         $dbVeza = new Baza();
    $dbVeza->spojiDB();
     $vrtic_id=$_POST['id_vrtica'];
    $naziv_vrtica = $_POST['naziv_vrtica'];
    $adresa_vrtica = $_POST['adresa_vrtica'];
    $sqlazurirajvrtic="update vrtic set naziv_vrtica='{$naziv_vrtica}', adresa_vrtica='{$adresa_vrtica}' where vrtic_id='{$vrtic_id}'";
    $rezsqlazurirajvrtic=$dbVeza->updateDB($sqlazurirajvrtic);
    
    $sqlTip="select tip_id ,naziv_tipa from tip where tip_id=17";
    $rezsqlTip=$dbVeza->selectDB($sqlTip);
    $rowTip= mysqli_fetch_assoc($rezsqlTip);
    $nazivTip=$rowTip['naziv_tipa'];
    
    $sqlDnevnikInsert="insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idkorisnika}', 17)";
    $rezsqlDnevniKInstert=$dbVeza->selectDB($sqlDnevnikInsert);
     $dbVeza->zatvoriDB();
       
   }
   if (isset($_POST['izbrisi'])) {
       $dbVeza = new Baza();
    $dbVeza->spojiDB();
     $vrtic_id=$_POST['id_vrtica'];
    $sqlbrisivrtic="delete from vrtic where vrtic_id='{$vrtic_id}'";
    $rezbrisivrtic=$dbVeza->updateDB($sqlbrisivrtic);
     $sqlTip="select tip_id ,naziv_tipa from tip where tip_id=18";
    $rezsqlTip=$dbVeza->selectDB($sqlTip);
    $rowTip= mysqli_fetch_assoc($rezsqlTip);
    $nazivTip=$rowTip['naziv_tipa'];
    
    $sqlDnevnikInsert="insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idkorisnika}', 18)";
    $rezsqlDnevniKInstert=$dbVeza->selectDB($sqlDnevnikInsert);
     $dbVeza->zatvoriDB();
       
   }
   
   if (isset($_POST['dodajmoderator'])) {
       $dbVeza = new Baza();
    $dbVeza->spojiDB();
     $vrtic_id=$_POST['id_vrtica'];
     $moderator_id=$_POST['korisnikcbox'];
    $sqlmoderator="update vrtic set korisnik_korisnik_id='{$moderator_id}' where vrtic_id='{$vrtic_id}'";
    $rezmoderator=$dbVeza->updateDB($sqlmoderator);
     $sqlTip="select tip_id ,naziv_tipa from tip where tip_id=8";
    $rezsqlTip=$dbVeza->selectDB($sqlTip);
    $rowTip= mysqli_fetch_assoc($rezsqlTip);
    $nazivTip=$rowTip['naziv_tipa'];
    
    $sqlDnevnikInsert="insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idkorisnika}', 8)";
    $rezsqlDnevniKInstert=$dbVeza->selectDB($sqlDnevnikInsert);
     $dbVeza->zatvoriDB();
       
   }
   
   if (isset($_POST['izbrisimoderator'])) {
       $dbVeza = new Baza();
    $dbVeza->spojiDB();
     $vrtic_id=$_POST['id_vrtica'];
    $sqlmoderatordelete="update vrtic set korisnik_korisnik_id=NULL where vrtic_id='{$vrtic_id}'";
    $rezmoderatordelete=$dbVeza->updateDB($sqlmoderatordelete);
     $sqlTip="select tip_id ,naziv_tipa from tip where tip_id=19";
    $rezsqlTip=$dbVeza->selectDB($sqlTip);
    $rowTip= mysqli_fetch_assoc($rezsqlTip);
    $nazivTip=$rowTip['naziv_tipa'];
    
    $sqlDnevnikInsert="insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idkorisnika}', 19)";
    $rezsqlDnevniKInstert=$dbVeza->selectDB($sqlDnevnikInsert);
     $dbVeza->zatvoriDB();
       
   }
   

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Upravljaj vrtićima</title>
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
                 <?php include './forma_search_odjava.php';?>
            </div>
        </header>

        <div class="naslov">
            <h1>UPRAVLJAJ VRTIĆIMA</h1><br>
        </div>
        <div class="popis_vrticaadmin">
            <table id="popis_table3">
                <thead>
                    <tr>
                        <th>ID vrtića</th>
                        <th>Naziv vrtića</th>
                        <th>Adresa vrtića</th>
                        <th>ID moderatora</th>
                    </tr>
                </thead>
                <tbody id="tablica_vrticaadminbody" for="popis_vrtica">
                  
                </tbody>
                
            </table>
        </div>
        <div class="login_form">
            <form method="post" action="" id="forma_vrtic" >


                <div class="container">
                    <label for="id_vrtica"><b>ID vrtića(prazno ako unosite novi)</b></label><br>
                    <input type="text" placeholder="Unesite ID vrtića" name="id_vrtica" id="id_vrtica" style="height:47px ;font-size:20px"><br><br>
                    <label for="naziv_vrticavrtica"><b>Naziv vrtića</b></label><br>
                    <input type="text" placeholder="Unesite naziv vrtića" name="naziv_vrtica" id="naziv_vrtica"  style="height:47px ;font-size:20px"><br><br>
                    <label for="adresa_vrtica"><b>Adresa vrtića</b></label><br>
                    <input type="text" placeholder="Unesite adresu vrtića" name="adresa_vrtica" id="adresa_vrtica"   style="height:47px ;font-size:20px"><br><br>
                     <label for="korisnik"><b>Moderator(bitan samo kod gumbova za moderatora)</b></label><br>
                    <select name="korisnikcbox" id="korisnikcbox" style="height:47px;width:247px;font-size:20px;">
                    </select><br><br>
                    
                    <input class="regbtn" type="submit" name="unesibutton" id="unesibutton" value="Unesi vrtić">
                    <input class="regbtn" type="submit" name="azuriraj" id="azuriraj" value="Ažuriraj vrtić">
                    <input class="regbtn" type="submit" name="izbrisi" id="izbrisi" value="Izbriši vrtić"><br><br>
                    <input class="regbtn" type="submit" name="dodajmoderator" id="dodajmoderator" value="Dodaj moderatora">
                    <input class="regbtn" type="submit" name="izbrisimoderator" id="izbrisimoderator" value="Izbriši moderatora">
              <!--      
                    <button type="button" class="azurirajvrtic" name="azuriraj" id="azuriraj">Ažuriraj vrtić</button><br><br>
                      <button type="button" class="brisivrtic" name="izbrisi" id="izbrisi"> Izbriši vrtić</button>
              -->
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
