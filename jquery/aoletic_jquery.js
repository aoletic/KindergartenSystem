
function DobijPozive() {
    $.ajax({
        url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiPozive`,
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            var red = '<tr>';
            $.each(data, function (index, key) {
                red += `\n<td><a id="datum_od" >${data[index].datum_od}</a></td>\n<td><a id="datum_do" >${data[index].datum_do}</a></td>\n
                <td><a id="mjesta" >${data[index].broj_mjesta}</a></td>
                <td><a id="skupina" >${data[index].naziv_skupine}</a></td>\n<td><a id="vrtic" >${data[index].naziv_vrtica}</a></td>\n<td><a id="korisnik_ime" >${data[index].ime}</a></td>\n
                <td><a id="korisnik_prezime" >${data[index].prezime}</a></td></tr>`;
            });
            $("tbody[id=tablica_pozivabody]").append(red);

            $("#popis_table2").dataTable();
        }

    });

}

function DobijVrtice() {

    $.ajax({
        url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiVrtice`,
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            var red = '<tr>';
            $.each(data, function (index, key) {
                red += `\n<td><a id="naziv_vrtica" >${data[index].naziv_vrtica}</a></td>\n<td><a id="adresa_vrtica" >${data[index].adresa_vrtica}</a></td>\n
                <td><a id="ocjena" >${data[index].ocjena}</a></td></tr>`;
            });
            $("tbody[id=tablica_vrticabody]").append(red);

            $("#popis_table1").dataTable();
        }

    });

}
/*
$("#popis_table1").on("click", "#naziv_vrtica", function () {
    var red = $(this).closest("tr");
    naziv_vrtica = red.find("td:first").text();
    $('#tablica_slike').show();

    $.ajax({
        url: 'https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?DobijSliku',
        type: 'GET',
        data: {naziv_vrtica},
        dataType: 'json',
        success: function (data) {

            var red = '<tr>';
            $.each(data, function (index, key) {
                red += `\n<td><a id="ime_djeteta" >${data[index].ime_djeteta}</a></td>\n<td><a id="prezime_djeteta" >${data[index].prezime_djeteta}</a></td>\n
                <td><img src="multimedija/'+ ${data[index].slika_djeteta}" style="width:200px;"></tr>`;
            });
            $("tbody[id=tablica_slikabody]").append(red);

            $("#tablica_slike").dataTable();
        }

    });

});
*/
function DobijVrticeAdmin() {
    $.ajax({
        url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiVrticeAdmin`,
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            var red = '<tr>';
            $.each(data, function (index, key) {
                red += `\n<td><a id="vrtic_id" >${data[index].vrtic_id}</a></td>\n<td><a id="naziv_vrtica" >${data[index].naziv_vrtica}</a></td>\n<td><a id="adresa_vrtica" >${data[index].adresa_vrtica}</a></td>\n
                <td><a id="korisnik_korisnik_id" >${data[index].korisnik_korisnik_id}</a></td></tr>`;
            });
            $("tbody[id=tablica_vrticaadminbody]").append(red);

            $("#popis_table3").dataTable();
        }

    });

}

function DobijDjecuIRacune() {
    $.ajax({
        url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiVrticeAdmin`,
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            var red = '<tr>';
            $.each(data, function (index, key) {
                red += `\n<td><a id="vrtic_id" >${data[index].vrtic_id}</a></td>\n<td><a id="naziv_vrtica" >${data[index].naziv_vrtica}</a></td>\n<td><a id="adresa_vrtica" >${data[index].adresa_vrtica}</a></td>\n
                <td><a id="korisnik_korisnik_id" >${data[index].korisnik_korisnik_id}</a></td></tr>`;
            });
            $("tbody[id=tablica_vrticaadminbody]").append(red);

            $("#popis_table3").dataTable();
        }

    });

}

$(document).ready(function () {
    $.ajax({
        url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiBrojDjece`,
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            var red = '<tr>';
            $.each(data, function (index, key) {
                red += `\n<td><a id="naziv_vrtica" >${data[index].naziv_vrtica}</a></td>\n<td><a id="broj" >${data[index].broj}</a></td></tr>`;
            });
            $("tbody[id=tablica_djece]").append(red);

            $("#popis_table4").dataTable();
        }

    });

});
$(document).ready(function () {
    $.ajax({
        url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiRacune`,
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            var red = '<tr>';
            $.each(data, function (index, key) {
                red += `\n<td><a id="naziv_vrtica" >${data[index].naziv_vrtica}</a></td>\n<td><a id="neplaceni" >${data[index].neplaceni}</a></td>\n
                <td><a id="placeni" >${data[index].placeni}</a></td></tr>`;
            });
            $("tbody[id=tablica_racuna]").append(red);

            $("#popis_table5").dataTable();
        }

    });

});

$(document).ready(function () {
    $.ajax({
        url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiOcjene`,
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            var red = '<tr>';
            $.each(data, function (index, key) {
                red += `\n<td><a id="ocjena_vrtica_id" >${data[index].ocjena_vrtica_id}</a></td>\n<td><a id="ocjena" >${data[index].ocjena}</a></td>\n
                <td><a id="ocjena_mjesec" >${data[index].ocjena_mjesec}</a></td>\n<td><a id="vrtic_vrtic_id" >${data[index].vrtic_vrtic_id}</a></td></tr>`;
            });
            $("tbody[id=tablica_ocjene]").append(red);

            $("#popis_table6").dataTable();
        }

    });

});
/*
 $(document).ready(function () {
 $.ajax({
 url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiSkupineMod`,
 type: "POST",
 dataType: 'JSON',
 
 success: function (data) {
 var red = '<tr>';
 $.each(data, function (index, key) {
 red += `\n<td><a id="skupina_id" >${data[index].skupina_id}</a></td>\n<td><a id="naziv_skupine" >${data[index].naziv_skupine}</a></td>\n
 <td><a id="cijena_skupine" >${data[index].cijena_skupine}</a></td>\n<td><a id="vrtic_vrtic_id" >${data[index].vrtic_vrtic_id}</a></td></tr>`;
 });
 $("tbody[id=tablica_skupine]").append(red);
 
 $("#popis_table7").dataTable();
 }
 
 });
 
 });
 */
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function ispuniusername() {
    korime = document.getElementById("username");
    var user = readCookie("username");
    korime.value = user;
}
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function uvjeticookie() {
    uvjeti = document.getElementById('uvjeti');
    setCookie('uvjetikoristenja', 'prihvaceno', 2);
    uvjeti.style.display = 'none';
}

$(document).ready(function () {
    $.ajax({
        url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiKorisnickaImenaCbox`,
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            $.each(data, function (index, key) {
                $("#korisnikcbox").append($("<option></option>").val(this['korisnik_id']).html(this['korisnicko_ime']));
            });
        }
    });
});

$(document).ready(function () {
    $.ajax({
        url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiVrticeAdmin`,
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            $.each(data, function (index, key) {
                $("#vrticcbox").append($("<option></option>").val(this['vrtic_id']).html(this['naziv_vrtica']));
            });
        }
    });
})
$(document).ready(function () {
    $.ajax({
        url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiSkupine`,
        type: "POST",
        dataType: 'JSON',
        success: function (data) {

            $.each(data, function (index, key) {
                $("#skupinacbox").append($("<option></option>").val(this['skupina_id']).html(this['naziv_skupine']));
            });
        }
    });
});


$(document).ready(function () {
    $("#popis_table7").dataTable();
    $("#popis_table8").dataTable();
    $("#popis_table9").dataTable();
    $("#popis_table10").dataTable();
    $("#popis_table11").dataTable();
    $("#popis_table12").dataTable();
    $("#popis_table13").dataTable();
    $("#popis_table14").dataTable();
});

function createPDF() {
        var sTable = document.getElementById('popis_table13').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>Profile</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable+'<br>');         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); 	// CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    }







