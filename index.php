<?php include 'Session/sesion_class.php';
Sesija::kreirajSesiju();


?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Početna stranica</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="aoletic">
        <meta name="descriptin" content="Početna stranica WebDiP projekta">
        <meta name="keywords" content="WebDiP, Projekt, Vrtić">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/aoletic.css" rel="stylesheet" type="text/css">
        <script src="javascript/aoletic_sidebar.js"></script>   
         <script src="jquery/aoletic_jquery.js" type="text/javascript"></script>  
    </head>




    <body id="sidebar_push" class="resetka">
        <header class="zaglavje">
           <?php include './meni.php'; ?>

            <div id="main">
                <button class="openbtn" onclick="openNav()">&#9776; IZBORNIK</button>
            </div>

            <div class="header-form">
                 <?php include './forma_search_odjava.php';?>
            </div>
        </header>
        <?php
                if (!isset($_COOKIE['uvjeti'])) {
                    echo '
                        <div id="uvjeti">
                            <div class="">
                              <button id="buttonuvjeti" class="info_gumb" onclick="uvjeticookie()" style="transform: translate(420%,-50%)";>Prihvati uvjete</button><br>
                            </div>
                          </div>
                        ';
                }
                ?>

        <div class="naslov">
            <h1>DJEČJI VRTIĆI</h1>
        </div>

        <div class="info_podrucje">
            <button class="info_gumb" onclick="on()">VIŠE INFORMACIJA</button>
        </div>

        <div id="overlay" onclick="off()">
            <div id="text">Sustav za upravljanje prijava u programe dječjih vrtića i rangiranje dječjih vrtića prema uspješnosti.</div>
            <div id="exit_text">Pritisnite bilo gdje za zatvaranje dodatnih informacija.</div>
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
