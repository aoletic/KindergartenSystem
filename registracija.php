
<?php
include 'PHP Class/baza_class.php';
include 'Session/sesion_class.php';
$vrijeme = date('Y/m/d H:i:s');

if (isset($_POST['regbutton'])) {

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $potvrda = $_POST['potvrda'];
    $salt="f1nd1ngn3m0";
    $sha1 = sha1($password).$salt;
    $aktivacijski_kod = md5(rand());
    $greska="nema";
    

    if (!preg_match("/^[A-Ža-ž]+$/i", $ime)) {
        $greska = "Ime treba sadržavati samo slova!";
    }

    if (!preg_match("/^[A-Ža-ž]+$/i", $prezime)) {
        $greska = "Prezime treba sadržavati samo slova!";
    }

    if (!preg_match("/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/", $email)) {
        $greska = "Email mora sadržavati samo alfanumeričke znakove, ne smije imati razmak te mora imati i domenu!";
    }

    if (preg_match("/[^A-Za-z0-9]/i", $username)) {
        $greska = "Korisničko ime treba sadržavati samo slova i brojke!";
    }

    if (preg_match("/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/", $password)) {
        $greska = "Lozinka treba sadržavati minimalno 8 znakova, barem jedno slovo te barem jedan specijalni znak!";
    }

    if ($password !== $potvrda) {
        $greska = "Lozinke se ne podudaraju!";
    }

    if ($greska === "nema") {
        $dbVeza = new Baza();
        $dbVeza->spojiDB();
        $sqlNoviKorisnik = "insert into korisnik (korisnik_id, ime, prezime, korisnicko_ime, email,lozinka,  lozinka_sha1, aktivacijski_kod, verificiran,"
                . " uvjeti,uloga_uloga_id)"
                . "VALUES (default, '{$ime}', '{$prezime}', '{$username}', '{$email}', '{$password}',  '{$sha1}', '{$aktivacijski_kod}', 'ne', NULL, '3')";

        $rezultatNoviKorisnik = $dbVeza->selectDB($sqlNoviKorisnik);

        if ($rezultatNoviKorisnik === true) {
            $sqlKorisnik="SELECT * FROM korisnik where korisnicko_ime='{$username}'";
            $rezultat=$dbVeza->selectDB($sqlKorisnik);
            $podaci = mysqli_fetch_assoc($rezultat);
            $id_korisnik=$podaci['korisnik_id'];
            $ime = $podaci['ime'];
            $prezime = $podaci['prezime'];
            $aktivacijski_kod = $podaci['aktivacijski_kod'];
            $email = $podaci['email'];

            $direktorij_url = "https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/";
            $mail_to = $email;
            $mail_from = "From: admin@djecivrtici.hr";
            $mail_subject = "Aktivacija korisničkog racuna";
            $mail_body = "Poštovani/na " . $ime . " " . $prezime . ",
                    Zahvaljujemo vam se na registraciji. Vaš račun će biti valjan nakon što ga aktivirate pomoću ovog linka.
                    Otvorite ovaj link za aktivaciju svojeg računa - " . $direktorij_url . "aktivacija_email.php?aktivacijski_kod=" . $aktivacijski_kod . "
                    Link za aktivaciju vrijedi 7 sati!
                    Hvala, Vaši administratori";
            mail($mail_to, $mail_subject, $mail_body, $mail_from);
            $message="Čestitamo, uspješno ste kreirali račun!"
            . "Na mail ste dobili aktivacijski kod.";
            
                     $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=14";
                    $rezsqlTip = $dbVeza->selectDB($sqlTip);
                    $rowTip = mysqli_fetch_assoc($rezsqlTip);
                    $nazivTip = $rowTip['naziv_tipa'];

                    $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                            . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$id_korisnik}',14)";
                    $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

        }
    }
    $dbVeza->zatvoriDB();
}
?>

<!DOCTYPE html>
<html>

    <head>

        <title>Registracija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="aoletic">
        <meta name="descriptin" content="Početna stranica WebDiP projekta">
        <meta name="keywords" content="WebDiP, Projekt, Vrtić">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
        <link href="css/aoletic.css" rel="stylesheet" type="text/css">
        <link href="css/aoletic_registracija.css" rel="stylesheet" type="text/css">     
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="javascript/aoletic_sidebar.js" type="text/javascript"></script>
        <script src="javascript/aoletic_registracija.js" type="text/javascript"></script>   
    </head>

    <body id="sidebar_push" class="resetka" onload="provjeriRegistraciju()" >
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
            <h1>REGISTRACIJA</h1>
        </div>
        <div class="login_form">
            <form method="post" action="" id="forma_registracija" onsubmit="return provjeriCaptchu();">


                <div class="container">
                    <label for="nazivvrtica"><b>Ime</b></label><br>
                    <input type="text" placeholder="Unesite vaše ime" name="ime" id="ime" required style="height:47px ;font-size:20px"><br><br>
                    <label for="prezime"><b>Prezime</b></label><br>
                    <input type="text" placeholder="Unesite prezime" name="prezime" id="prezime"  required style="height:47px ;font-size:20px"><br><br>
                    <label for="email"><b>Email</b></label><br>
                    <input type="text" placeholder="Unesite email" name="email" id="email" required style="height:47px ;font-size:20px"><br><br>
                    <label for="username" id="usernamelabel"><b>Korisničko ime</b></label><br>
                    <input type="text" placeholder="Unesite korisničko ime" name="username" id="username" required style="height:47px ;font-size:20px"><br><br>

                    <label for="password" id="passlabel"><b>Lozinka</b></label><br>
                    <input type="password" placeholder="Unesite lozinku" name="password" id="password" required style="height:47px ;font-size:20px"><br><br>
                    <label for="potvrda"><b>Potvrda lozinke</b></label><br>
                    <input type="password" placeholder="Ponovite lozinku" name="potvrda" id="potvrda" required style="height:47px ;font-size:20px"><br><br>
                    <div class="g-recaptcha" data-sitekey="6LfdgAEVAAAAAG9k2G_OtOs-dSYN0IE6Qja24MJx" style="transform: scale(0.9);width: 304px; height: 78px; margin-left: 80px;""></div>
                    <input class="regbtn" type="submit" name="regbutton" id="regbutton" value="Registriraj se">
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <button type="button" class="cancelbtn">Cancel</button>
                    <button type="button" class="regbtn" onclick="window.location.href = 'login.php'">Prijavi se</button>

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
             <?php
                    if (isset($greska))  {
                       
                        echo"<p> $greska</p>";
                        
                    }
                    ?>
        </footer>

    </body>
</html>
