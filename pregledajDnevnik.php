<?php
include 'Session/sesion_class.php';
include 'PHP Class/baza_class.php';
error_reporting(0);
Sesija::kreirajSesiju();
$vrijeme = date('Y-m-d');
$korisnik = $_SESSION["korisnik"];
$dbVeza = new Baza();
$dbVeza->spojiDB();
$sqlselect = "select * from korisnik where korisnicko_ime='{$korisnik}'";
$rezsql = $dbVeza->selectDB($sqlselect);
$row = mysqli_fetch_assoc($rezsql);
$idkorisnik= $row['korisnik_id'];

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Pregledaj dnevnik</title>
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
        <script type="text/javascript" src="jspdf.debug.js"></script>
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
            <h1>PREGLEDAJ DNEVNIK</h1><br>
        </div>
        <div class="popis_vrtica" style= "transform: translate(20%, -25%);">
            <table id="popis_table13">
                <thead>
                    <tr>
                        <th>ID radnje</th>
                        <th>Radnja</th>
                        <th>Vrijeme radnje</th>
                        <th>Username korisnika koji je obavio radnju</th>
                    </tr>
                </thead>
                <tbody id="tablica_dolascikor" for="popis_vrtica">
                    <?php
                   if (isset($_POST['prikazidnevnik'])) {
                       $datetime1=$_POST['datetime1'];
                       $datetime2=$_POST['datetime2'];
                     $dbVeza = new Baza();
                    $dbVeza->spojiDB();
                   
                    $sqlDnevnik = "select dnevnik.dnevnik_id, dnevnik.radnja, dnevnik.datum_vrijeme, korisnik.korisnicko_ime from dnevnik left join"
                            . " korisnik on dnevnik.korisnik_korisnik_id=korisnik.korisnik_id where datum_vrijeme>='{$datetime1}' and datum_vrijeme<='{$datetime2}'";
                    $rezultatDnevnik = $dbVeza->selectDB($sqlDnevnik);
                    $dataRow = "";
                    while ($row = mysqli_fetch_array($rezultatDnevnik)) {
                        $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
                    }
                    echo $dataRow;
                    $dbVeza->zatvoriDB();
                    
                   }
                    ?>
                </tbody>

            </table>
        </div>
          <div class="login_form">   
           <form method="post" action="" id="forma_vrtic" style= "transform: translate(20%, 165%);">

                <div class="container">
                      <label for="datetime1"><b>Datum od</b></label><br>
                      <input type="datetime-local" class="combobox" name="datetime1" id="datetime2"><br><br>
                      <label for="datetime2"><b>Datum do</b></label><br>
                    <input type="datetime-local" class="combobox" name="datetime2" id="datetime2"><br><br>

                    <input class="regbtn" type="submit" name="prikazidnevnik" id="prikazidnevnik" value="Prikazi dnevnik">
                       <input type="button" value="Create PDF" class="regbtn" id="btPrint" onclick="createPDF()">

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
