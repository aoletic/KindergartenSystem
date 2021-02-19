<?php
include 'PHP Class/baza_class.php';
include 'Session/sesion_class.php';
Sesija::kreirajSesiju();


if (isset($_POST['username']) && isset($_POST['password'])) {
    $vrijeme = date('Y/m/d H:i:s');
    $dbVeza = new Baza();
    $dbVeza->spojiDB();

    $user = $_POST['username'];
    $pass = $_POST['password'];
    $auth = false;


    $sqlselect = "select * from korisnik where korisnicko_ime='{$user}'";
    $sqlselectpass = "select * from korisnik where korisnicko_ime='{$user}' and lozinka='{$pass}'";
    $sqlresetpokusaj = "update korisnik set pogreska_lozinka=0 where korisnicko_ime='{$user}'";
    $sqldodajpokusaj = "update korisnik set pogreska_lozinka=pogreska_lozinka + 1 where korisnicko_ime='{$user}' ";

    $sel1 = $dbVeza->selectDB($sqlselect);
    $sel2 = $dbVeza->selectDB($sqlselectpass);

    if ($sel1->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($sel1)) {
            if ($sel2->num_rows > 0 && $row['pogreska_lozinka'] < 3 && $row['verificiran'] == 'da') {
                while ($row = mysqli_fetch_assoc($sel2)) {
                    $dbVeza->updateDB($sqlresetpokusaj);
                    $auth = true;
                    $razinapristupa = $row['uloga_uloga_id'];
                    if (isset($_POST['zapamtime'])) {
                        setcookie("username", $user);
                    }
                    
                    $nadiIDkor = "select korisnik_id from korisnik where korisnicko_ime='$user'";
                    $userID = $dbVeza->selectDB($nadiIDkor);
                    $row3 = mysqli_fetch_assoc($userID);
                    $IDUsera = $row3['korisnik_id'];
                    
                    
                }
            } else {
                $dbVeza->updateDB($sqldodajpokusaj);
            }
        }
        if ($auth === true) {

            Sesija::kreirajKorisnika($user, $razinapristupa);
            
                    $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=11";
                    $rezsqlTip = $dbVeza->selectDB($sqlTip);
                    $rowTip = mysqli_fetch_assoc($rezsqlTip);
                    $nazivTip = $rowTip['naziv_tipa'];

                    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$IDUsera}',11)";
                    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);
            
          
            header("Location:index.php");
        }
        $dbVeza->zatvoriDB();
    }
}
if ($_SERVER["HTTPS"] != "on") {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
    ?>
    <!DOCTYPE html>
    <!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
    -->
    <html>
        <head>
            <title>Prijava</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="aoletic">
            <meta name="descriptin" content="Početna stranica WebDiP projekta">
            <meta name="keywords" content="WebDiP, Projekt, Vrtić">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link href="css/aoletic.css" rel="stylesheet" type="text/css">
            <link href="css/aoletic_login.css" rel="stylesheet" type="text/css">
            <script src="javascript/aoletic_sidebar.js"></script>   
            <script src="jquery/aoletic_jquery.js" type="text/javascript"></script>  
        </head>




        <body id="sidebar_push" class="resetka" onload="ispuniusername()">
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
                <h1>PRIJAVA</h1>
            </div>
            <div class="login_form">
                <form action="" method="post">

                    <div class="container">
                        <label for="username"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="username" id="username" required="" style="height:47px ;font-size:20px"><br><br>

                        <label for="password"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required="" style="height:47px ;font-size:20px"> <br><br>
                        <label for="zapamtime"><b>Zapamti me</b></label>
                        <input type="checkbox" name="zapamtime" id="zapamtime">
                        <button type="submit">Login</button>
                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                        <button type="button" classs="regbtn" onclick="window.location.href = 'forgot_password.php'">Zaboravljena lozinka</button>
                        <button type="reset" class="cancelbtn">Cancel</button>
                        <button type="button" class="regbtn" onclick="window.location.href = 'registracija.php'">Registriraj se</button>
                        <div id="greske">  

                            <?php
                            if (isset($message)) {
                                echo"<p> $message</p>";
                            }
                            ?>

                        </div>

                    </div>
                </form>
            </div>


            <footer class="podnozje" id="podnozje_push">
                <address>
                    Kontakt:
                    <a href="mailto:aoletic@foi.hr" style="color:white">Antonio Oletić</a>
                    <p>&copy; 2020</p>
                </address>
                <?php
                var_dump($_SESSION);
                ?>
        </footer>
    </body>





</html>
