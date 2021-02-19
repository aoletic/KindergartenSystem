<?php
include 'PHP Class/baza_class.php';
include 'Session/sesion_class.php';


$message = '';
if (isset($_POST['posalji'])) {
    $dbVeza = new Baza();
    $dbVeza->spojiDB();
    $email = $_POST['email'];
    $sqlDobijEmail = "SELECT * from korisnik WHERE email ='$email'";
    $rezultatEmail = $dbVeza->selectDB($sqlDobijEmail);
    if ($rezultatEmail->num_rows > 0) {
        while ($row = $rezultatEmail->fetch_assoc()) {

            function RandomPassword() {
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $password = array();
                $alphaLength = strlen($alphabet) - 1;
                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $password[] = $alphabet[$n];
                }
                return implode($password);
            }

            $id_korisnik = $row['id_korisnik'];
            $nova_lozinka = RandomPassword();
            $sqlNovaLozinka = "update korisnik set lozinka='{$nova_lozinka}' where email='$email'";
            $rezultatUpdateLozinka = $dbVeza->updateDB($sqlNovaLozinka);
            $mail_to = $email;
            $mail_subject = "Generirana je nova lozinka za vaš račun";
            $mail_body = "Ovo je nova lozinka za vaš račun: $nova_lozinka";
            $mail_from = "From:admin@djecivrtici.hr";
            mail($mail_to, $mail_subject, $mail_body, $mail_from);
            $message = "Nova lozinka je uspješno poslana na vaš email!";

            $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=29";
            $rezsqlTip = $dbVeza->selectDB($sqlTip);
            $rowTip = mysqli_fetch_assoc($rezsqlTip);
            $nazivTip = $rowTip['naziv_tipa'];

            $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                    . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$id_korisnik}', 29)";
            $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

            $dbVeza->zatvoriDB();
        }
    } else {
        $message = "Vaš email ne postoji u našoj bazi!";
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Zaboravljena lozinka</title>
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
                <?php include './forma_search_odjava.php'; ?>
            </div>
        </header>

        <div class="naslov">
            <h1>Zaboravljena lozinka</h1>
        </div>
        <form class="container" novalidate name="prijava" id="prijava" method="post" action=""  style="transform: translate(110%,-50%);">
            <label for="email" style="height:47px ;font-size:20px">Unesite email: </label> <br>
            <input id="email" name="email" type="text" style="height:47px ;font-size:20px;"> <br>
            <input class="logingumb" id="posalji" name="posalji" type="submit" value="Pošalji novu lozinku"/>

        </form>
    </div>
    <div class="lozinkatekst">
        <?php
        if (isset($message)) {
            echo"<p> $message</p>";
        }
        ?>
    </div>
    <div >


        <footer class="podnozje" id="podnozje_push">
            <address>
                Kontakt:
                <a href="mailto:aoletic@foi.hr" style="color:white">Antonio Oletić</a>
                <p>&copy; 2020</p>
            </address>
        </footer>
</body>


</html>
