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
        <title>Popis poziva</title>
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




<body id="sidebar_push" class="resetka" name="pozivi" onload="DobijPozive()">
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
            <h1>POPIS POZIVA</h1>
        </div>
        <div class="popis_poziva">
            <table id="popis_table2">
                <thead>
                    <tr>
                        <th>Datum početka poziva</th>
                        <th>Datum završetka poziva</th>
                        <th>Broj mjesta skupine</th>
                        <th>Naziv skupine</th>
                        <th>Naziv vrtića</th>
                        <th>Ime kreatora poziva</th>
                        <th>Prezime kreatora poziva</th>
                    </tr>
                </thead>
                <tbody id="tablica_pozivabody" for="popis_table2">
                    
                </tbody>
            </table>
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
