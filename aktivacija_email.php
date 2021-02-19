<?php
$url=($_SERVER["REQUEST_URI"]);
$host = explode('=',$url);
include 'PHP Class/baza_class.php';
$message='';

$dbVeza = new Baza();
$dbVeza->spojiDB();


$sqlDobijAktivacijski="SELECT * from korisnik WHERE aktivacijski_kod ='".$host[1]."'";
$rezultatAktivacijski = $dbVeza->selectDB($sqlDobijAktivacijski);
    while ($row = mysqli_fetch_assoc($rezultatAktivacijski)) {        
   
            if ($row) {
                 if ($row['verificiran'] === 'ne') {
            $sqlUpdateAktivacijski="UPDATE korisnik SET verificiran='da' where korisnik_id='".$row['korisnik_id']."'";
            $rezultatUpdateAktivacijski = $dbVeza->updateDB($sqlUpdateAktivacijski);
            $message="Vaš račun je uspješno aktiviran! Možete otići na prijavu klikom na gumb ispod.";
        }
        else{
            $message="Vaš račun je već od prije aktiviran. Možete otići na prijavu klikom na gumb ispod.";
            
        }
    }
        
    }
     $dbVeza->zatvoriDB();
    

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Aktivacija email</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="aoletic">
        <meta name="descriptin" content="Početna stranica WebDiP projekta">
        <meta name="keywords" content="WebDiP, Projekt, Vrtić">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/aoletic.css" rel="stylesheet" type="text/css">
        <script src="javascript/aoletic_sidebar.js"></script>
         <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> 
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script> 
        <script type ="text/javascript" src="jquery/aoletic_jquery.js"></script>
    </head>




    <body id="sidebar_push" class="resetka" name="vrtici" onload="DobijVrtice()">
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
            <h1>Aktivacija emailom</h1>
        </div>
        <div class="aktivacijskitekst">
         <?php
                    if (isset($message)) {
                        echo"<p> $message</p>";
                    }
                    ?>
            </div>
        <div >
                    <button type="button" class="openbtn" onclick="window.location.href = 'login.php'" style="transform: translate(700%,-50%);">Prijavi se</button>

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
