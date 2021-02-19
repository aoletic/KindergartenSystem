<?php

if (!isset($_SESSION['uloga'])) {
    echo "<div id=\"mySidebar\" class=\"sidebar\">
                <a href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\">&times;</a>
                <a href=\"index.php\">Početna</a>
                <a href=\"registracija.php\">Registracija</a>
                <a href=\"login.php\">Prijava</a>
                <a href=\"Popis_vrtica.php\">Popis vrtića</a>
                <a href=\"Popis_poziva.php\">Popis javnih poziva</a>
                <a href=\"o_autoru.html\">O autoru</a>
                <a href=\"dokumentacija.html\">Dokumentacija</a>
            </div> ";
}

if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] === "3") {
    echo "<div id=\"mySidebar\" class=\"sidebar\">
                <a href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\">&times;</a>
                <a href=\"index.php\">Početna</a>
                <a href=\"Popis_vrtica.php\">Popis vrtića</a>
                <a href=\"Popis_poziva.php\">Popis javnih poziva</a>
                <a href=\"prijaviDijete.php\">Prijavi dijete</a>
                <a href=\"pregledajPrijaveKor.php\">Pregledaj prijave</a>
                <a href=\"pregledajDolaskeKor.php\">Popis dolazaka djeteta</a>
                <a href=\"pregledajRacuneKor.php\">Pregledaj račune</a>
            </div> ";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] === "2") {
    echo "<div id=\"mySidebar\" class=\"sidebar\">
                <a href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\">&times;</a>
                <a href=\"index.php\">Početna</a>
                <a href=\"Popis_vrtica.php\">Popis vrtića</a>
                <a href=\"Popis_poziva.php\">Popis javnih poziva</a>
                <a href=\"kreirajSkupine.php\">Kreiraj skupinu</a>
                 <a href=\"kreirajPoziv.php\">Kreiraj javni poziv</a>
                  <a href=\"pregledajPrijave.php\">Pregledaj prijave za upise</a>
                   <a href=\"pregledajRacune.php\">Pregledaj račune</a>
                    <a href=\"evidentirajDolazak.php\">Evidentiraj dolaske djece</a>
                
            </div> ";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] === "1") {
    echo "<div id=\"mySidebar\" class=\"sidebar\">
                <a href=\"javascript:void(0)\" class=\"closebtn\" onclick=\"closeNav()\">&times;</a>
                <a href=\"index.php\">Početna</a>
                   <a href=\"Popis_vrtica.php\">Popis vrtića</a>
                <a href=\"Popis_poziva.php\">Popis javnih poziva</a>
                <a href=\"upravljajVrticima.php\">Upravljaj vrtićima</a>
                <a href=\"kreirajPozivAdmin.php\">Upravljaj javnim pozivima</a>
                    <a href=\"Popis_djece_racuna.php\">Pregledaj polaznike vrtića sa računima</a>
                     <a href=\"evidentirajDolazakAdmin.php\">Evidentiraj dolaske djece</a>
                    <a href=\"ocjeniVrtic.php\">Ocijeni rad vrtića</a>
                <a href=\"kreirajSkupineAdmin.php\">Kreiraj skupinu</a>
                 <a href=\"kreirajPozivAdmin.php\">Kreiraj javni poziv</a>
                  <a href=\"pregledajPrijaveAdmin.php\">Pregledaj prijave za upise</a>
                   <a href=\"otkljucajRacune.php\">Otključaj/zaključaj račune</a>
                    <a href=\"pregledajRacuneAdmin.php\">Pregledaj račune</a>
                   <a href=\"pregledajDnevnik.php\">Pregledaj dnevnik</a>
  </div> ";
}
?>

    