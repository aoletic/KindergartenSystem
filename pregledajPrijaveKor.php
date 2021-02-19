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


if (isset($_POST['upisi_dijete'])) {
    $id_prijave = $_POST['id_prijave'];
    $ime_djeteta = $_POST['ime_djeteta'];
    $prezime_djeteta = $_POST['prezime_djeteta'];
    $datum_rodenja = $_POST['datum_rodenja'];
    $spol_djeteta = $_POST['spol_djeteta'];
    $suglasnost = $_POST['suglasnost'];
    $userfile = $_FILES['dokument']['tmp_name'];
    $userfile_name = $_FILES['dokument']['name'];
    $userfile_size = $_FILES['dokument']['size'];
    $userfile_type = $_FILES['dokument']['type'];
    $userfile_error = $_FILES['dokument']['error'];
    if ($userfile_error > 0) {
        echo 'Problem: ';
        switch ($userfile_error) {
            case 1: $greska .= 'Veličina veća od ' . ini_get('upload_max_filesize');
                break;
            case 2: $greska .= 'Veličina veća od ' . $_POST["MAX_FILE_SIZE"] . 'B';
                break;
            case 3: $greska .= 'Datoteka djelomično prenesena';
                break;
            case 4: $greska .= 'Datoteka nije prenesena';
                break;
        }
        exit;
    }

    $upfile = 'multimedija/' . $userfile_name;

    if (is_uploaded_file($userfile)) {
        if (!move_uploaded_file($userfile, $upfile)) {
            $greska .= "Problem: nije moguće prenijeti datoteku na odredište";
            exit;
        }
    } else {
        $greska .= "Problem: mogući napad prijenosom. Datoteka: " . $userfile_name;
        exit;
    }
    
    $dbVeza = new Baza();
    $dbVeza->spojiDB();

    $sqlSkupinaID = "SELECT upisi.skupina_skupina_id from upisi left join prijave on upisi.upisi_id=prijave.upisi_upisi_id where prijave.prijave_id='{$id_prijave}'";
    $rezSkupinaID = $dbVeza->selectDB($sqlSkupinaID);
    $row1 = $rezSkupinaID->fetch_assoc();
    $SkupinaID = $row1['skupina_skupina_id'];

    $sqlVrticID = "SELECT skupina.vrtic_vrtic_id from skupina left join upisi on skupina.skupina_id=upisi.upisi_id where upisi.skupina_skupina_id='{$SkupinaID}'";
    $rezVrticID = $dbVeza->selectDB($sqlVrticID);
    $row2 = $rezVrticID->fetch_assoc();
    $VrticID = $row2['vrtic_vrtic_id'];

    $sqlPrihvacen = "select prijave.prihvacen from prijave where prijave.prijave_id='{$id_prijave}'";
    $rezPrihvacen = $dbVeza->selectDB($sqlPrihvacen);
    $row3 = $rezPrihvacen->fetch_assoc();
    $Prihvacen = $row3['prihvacen'];
    if ($row3['prihvacen'] == 'da') {
        $sqlUpisiDijete = "insert into dijete(dijete_id, ime_djeteta, prezime_djeteta, godina_rodenja, "
                . "spol, slika_djeteta, koristenje_podataka, prijave_prijave_id, vrtic_vrtic_id)"
                . "VALUES(default, '{$ime_djeteta}', '{$prezime_djeteta}', '{$datum_rodenja}', '{$spol_djeteta}',"
                . "'{$userfile_name}', '{$suglasnost}', '{$id_prijave}', '{$VrticID}')";
        $rezUpisiDijete = $dbVeza->updateDB($sqlUpisiDijete);

        $sqlpostaviUpisan = "update prijave set upisan='da' where prijave_id='{$id_prijave}'";
        $rezPostaviUpisan = $dbVeza->updateDB($sqlpostaviUpisan);
        $message = "Uspješno ste upisali dijete!";

        $sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=6";
        $rezsqlTip = $dbVeza->selectDB($sqlTip);
        $rowTip = mysqli_fetch_assoc($rezsqlTip);
        $nazivTip = $rowTip['naziv_tipa'];

        $sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
                . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idkorisnika}', 6)";
        $rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

        $dbVeza->zatvoriDB();
    } else {
        $message = "Vaše dijete nije još prihvaćeno!";
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Prijavi dijete</title>
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


    <body id="sidebar_push" class="resetka" name="vrtici" onload="DobijPozive()">
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
            <h1>POPIS VAŠIH PRIJAVA</h1><br>
        </div>

        <div class="popis_poziva" style= "transform: translate(7%, 1%)">
            <table id="popis_table12">
                <thead>
                    <tr>
                        <th>ID prijave</th>
                        <th>Naziv skupine</th>
                        <th>Prijava prihvaćena</th>
                        <th>Dijete upisano</th>
                    </tr>
                </thead>
                <tbody id="tablica_prijavekor" for="popis_table12">
<?php
$dbVeza = new Baza();
$dbVeza->spojiDB();

$sqlPrijave = "SELECT prijave.prijave_id, skupina.naziv_skupine, prijave.prihvacen, prijave.upisan from prijave "
        . "left join upisi on prijave.upisi_upisi_id=upisi.upisi_id left join skupina on "
        . "upisi.skupina_skupina_id=skupina.skupina_id where prijave.korisnik_korisnik_id='{$idkorisnika}'";
$rezultatPrijave = $dbVeza->selectDB($sqlPrijave);
$dataRow = "";
while ($row = mysqli_fetch_array($rezultatPrijave)) {
    $dataRow = $dataRow . "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
}
echo $dataRow;

$sqlTip = "select tip_id ,naziv_tipa from tip where tip_id=5";
$rezsqlTip = $dbVeza->selectDB($sqlTip);
$rowTip = mysqli_fetch_assoc($rezsqlTip);
$nazivTip = $rowTip['naziv_tipa'];

$sqlDnevnikInsert = "insert into dnevnik (dnevnik_id, radnja, datum_vrijeme, korisnik_korisnik_id, tip_tip_id)"
        . "VALUES (default, '{$nazivTip}', '{$vrijeme}', '{$idkorisnika}', 5)";
$rezsqlDnevniKInstert = $dbVeza->selectDB($sqlDnevnikInsert);

$dbVeza->zatvoriDB();
?>
                </tbody>
            </table>
        </div>
        <div class="login_form" style= "transform: translate(5%, 0%);">
            <form method="post" action="" id="forma_vrtic" enctype="multipart/form-data">

                <div class="container">
                    <label for="id_prijave"><b>ID prijave(možete dijete upisati samo kao je prijava prihvaćena)</b></label><br>
                    <input type="text" placeholder="Unesite ID prijave" name="id_prijave" id="id_prijave" style="height:47px ;font-size:20px"><br><br>
                    <label for="ime_djeteta"><b>Ime djeteta</b></label><br>
                    <input type="text" placeholder="Unesite ime djeteta" name="ime_djeteta" id="ime_djeteta"  style="height:47px ;font-size:20px"><br><br>
                    <label for="ime_djeteta"><b>Prezime djeteta</b></label><br>
                    <input type="text" placeholder="Unesite prezime djeteta" name="prezime_djeteta" id="prezime_djeteta"  style="height:47px ;font-size:20px"><br><br>
                    <label for="datum_rodenja"><b>Datum rodenja(Y-M-D)</b></label><br>
                    <input type="text" placeholder="Unesite datum rodenja" name="datum_rodenja" id="datum_rodenja"  style="height:47px ;font-size:20px"><br><br>
                    <label for="spol_djeteta"><b>Spol(Muško/Žensko)</b></label><br>
                    <input type="text" placeholder="Unesite spol djeteta" name="spol_djeteta" id="spol_djeteta"  style="height:47px ;font-size:20px"><br><br>
                    <label for="suglasnost"><b>Suglasnost za prikazivanje slike(0-ne/1-da)</b></label><br>
                    <input type="text" placeholder="Unesite 0 ili 1" name="suglasnost" id="suglasnost"  style="height:47px ;font-size:20px"><br><br>
                    <label for="userfile">Odaberite sliku:</label>
                    <input type="file" id="dokument" name="dokument">
                    <input class="regbtn" type="submit" name="upisi_dijete" id="upisi_dijete" value="Upiši dijete"><br><br>

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
