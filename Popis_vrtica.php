<?php include 'Session/sesion_class.php';
Sesija::kreirajSesiju();


?>

<!DOCTYPE html>

<html>
    <head>
        <title>Popis vrtića</title>
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
            <h1>POPIS VRTIĆA</h1>
        </div>
        
        <div class="popis_vrtica">
            <table id="popis_table1">
                <thead>
                    <tr>
                        <th>Naziv vrtića</th>
                        <th>Adresa vrtića</th>
                        <th>Prosječna ocjena vrtića</th>
                    </tr>
                </thead>
                <tbody id="tablica_vrticabody" for="popis_vrtica">
                  
                </tbody>
            </table>
        </div>
 <!--       
        <div class="slike_korisnika">
            <table id="tablica_slike">
                <thead>
                    <tr>
                        <th>Ime djeteta</th>
                        <th>Prezime djeteta</th>
                        <th>Slika djeteta</th>
                    </tr>
                </thead>
                <tbody id="tablica_slikabody" for="tablica_slike">
                  
                </tbody>
            </table>
        </div>
      
-->


        <footer class="podnozje" id="podnozje_push">
            <address>
                Kontakt:
                <a href="mailto:aoletic@foi.hr" style="color:white">Antonio Oletić</a>
                <p>&copy; 2020</p>
            </address>
        </footer>
    </body>


</html>
