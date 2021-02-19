<?php
if (!isset($_SESSION['uloga'])) {
    echo "<form action=\"http://barka.foi.hr/WebDiP/2017/materijali/zadace/ispis_forme.php\" method=\"GET\">
        <input type=\"search\" size=\"12\" name=\"search\" style=\"height:47px ;font-size:20px\">
    <button type=\"submit\" ><i class=\"fa fa-search\"></i></button>
    </form>";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] === "3") {
     echo "<form action=\"http://barka.foi.hr/WebDiP/2017/materijali/zadace/ispis_forme.php\" method=\"GET\">
        <input type=\"search\" size=\"12\" name=\"search\" style=\"height:47px ;font-size:20px\">
    <button type=\"submit\" ><i class=\"fa fa-search\"></i></button>
    <a href=\"?logout\">Odjava</a>
    </form>";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] === "2") {
    echo "<form action=\"http://barka.foi.hr/WebDiP/2017/materijali/zadace/ispis_forme.php\" method=\"GET\">
        <input type=\"search\" size=\"12\" name=\"search\" style=\"height:47px ;font-size:20px\">
    <button type=\"submit\" ><i class=\"fa fa-search\"></i></button>
    <a href=\"?logout\">Odjava</a>
    </form>";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] === "1") {
    echo "<form action=\"http://barka.foi.hr/WebDiP/2017/materijali/zadace/ispis_forme.php\" method=\"GET\">
        <input type=\"search\" size=\"12\" name=\"search\" style=\"height:47px ;font-size:20px\">
    <button type=\"submit\" ><i class=\"fa fa-search\"></i></button>
    <a href=\"?logout\">Odjava</a>
    </form>";
}
if($_SERVER['QUERY_STRING'] === 'logout'){
        Sesija::obrisiSesiju();
        header("Location: login.php");
    }

?>

