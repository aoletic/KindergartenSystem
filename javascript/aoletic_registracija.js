var greska_ime = 1;
var greska_prezime = 1;
var greska_username = 1;
var greska_email = 1;
var greska_password = 1;
var greska_potvrda = 1;
var istoKorime = 1;

function provjeriRegistraciju() {
    ime = document.getElementById("ime");
    regbutton = document.getElementById("regbutton");
    regbutton.disabled = true;
    greska_ime = 1;
    ime.addEventListener("change", function () {
        let Slova = /^[A-Ža-ž]+$/i;

        if (ime.value.match(Slova)) {
            greska_ime = 0;
            ime.style.borderColor = "black";
        } else {
            greska_ime = 1;
            regbutton.disabled = true;
            alert("Ime treba sadržavati samo slova!");
            ime.style.borderColor = "red";
        }
        if (greska_ime === 0 && greska_prezime === 0 && greska_username === 0 && istoKorime===0 && greska_email === 0 && greska_password === 0 && greska_potvrda === 0) {
            regbutton.disabled = false;
            regbutton.style.backgroundColor = "blue";
        } else {
            regbutton.disabled = true;
            regbutton.style.backgroundColor = "red";
        }
    });
    prezime = document.getElementById("prezime");
    greska_prezime = 1;
    prezime.addEventListener("change", function () {
        let Slova = /^[A-Ža-ž]+$/i;

        if (prezime.value.match(Slova)) {
            greska_prezime = 0;
            prezime.style.borderColor = "black";
        } else {
            greska_prezime = 1;
            regbutton.disabled = true;
            alert("Prezime treba sadržavati samo slova!");
            prezime.style.borderColor = "red";
        }
        if (greska_ime === 0 && greska_prezime === 0 && greska_username === 0 && istoKorime===0 && greska_email === 0 && greska_password === 0 && greska_potvrda === 0) {
            regbutton.disabled = false;
            regbutton.style.backgroundColor = "blue";
        } else {
            regbutton.disabled = true;
            regbutton.style.backgroundColor = "red";
        }

    });
    username = document.getElementById("username");
    greska_username = 1;
    username.addEventListener("change", function () {
        let nisuAlfaNum = /[^A-Za-z0-9]/gi;

        if (username.value.match(nisuAlfaNum)) {
            greska_username = 1;
            alert("Korisničko ime treba sadržavati samo slova i brojke!");
            regbutton.disabled = true;
            username.style.borderColor = "red";
        } else {
            greska_username = 0;
            username.style.borderColor = "black";
        }
        if (greska_ime === 0 && greska_prezime === 0 && greska_username === 0 && istoKorime===0 && greska_email === 0 && greska_password === 0 && greska_potvrda === 0) {
            regbutton.disabled = false;
            regbutton.style.backgroundColor = "black";
        } else {
            regbutton.disabled = true;
            regbutton.style.backgroundColor = "red";
        }
    });
    email = document.getElementById("email");
    greska_email = 1;
    email.addEventListener("change", function () {
        let emailProvjera = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (email.value.match(emailProvjera)) {
            greska_email = 0;
            email.style.borderColor = "black";
        } else {
            greska_email = 1;
            regbutton.disabled = true;
            alert("Email mora sadržavati samo alfanumeričke znakove, ne smije imati razmak te mora imati i domenu!");
            email.style.borderColor = "red";
        }
        if (greska_ime === 0 && greska_prezime === 0 && greska_username === 0 && istoKorime===0 && greska_email === 0 && greska_password === 0 && greska_potvrda === 0) {
            regbutton.disabled = false;
            regbutton.style.backgroundColor = "black";
        } else {
            regbutton.disabled = true;
            regbutton.style.backgroundColor = "red";
        }
    });


    password = document.getElementById("password");

    greska_password = 1;
    password.addEventListener("change", function () {
        let passwordProvjera = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
        if (password.value.match(passwordProvjera)) {
            greska_password = 0;
            password.style.borderColor = "black";
        } else {
            greska_password = 1;
            regbutton.disabled = true;
            alert("Lozinka treba sadržavati minimalno 8 znakova, barem jedno slovo te barem jedan specijalni znak!");
            password.style.borderColor = "red";
        }
        if (greska_ime === 0 && greska_prezime === 0 && greska_username === 0 && istoKorime===0 && greska_email === 0 && greska_password === 0 && greska_potvrda === 0) {
            regbutton.disabled = false;
            regbutton.style.backgroundColor = "black";
        } else {
            regbutton.disabled = true;
            regbutton.style.backgroundColor = "red";
        }

    });

    potvrda = document.getElementById("potvrda");
    greska_potvrda = 1;
    potvrda.addEventListener("change", function () {
        if (password.value !== potvrda.value) {
            greska_potvrda = 1;
            regbutton.disabled = true;
            alert("Lozinke se ne podudaraju!");
            potvrda.style.borderColor = "red";
        } else {
            greska_potvrda = 0;
            potvrda.style.borderColor = "black";
        }
        if (greska_ime === 0 && greska_prezime === 0 && greska_username === 0 && istoKorime===0 && greska_email === 0 && greska_password === 0 && greska_potvrda === 0) {
            regbutton.disabled = false;
            regbutton.style.backgroundColor = "black";
        } else {
            regbutton.disabled = true;
            regbutton.style.backgroundColor = "red";
        }
    });


}
$(document).ready(function () {
    istoKorime=1;
    username = document.getElementById("username");
    username.addEventListener("change", function () {
        $.ajax({
            url: `https://barka.foi.hr/WebDiP/2019_projekti/WebDiP2019x091/upiti.php?dohvatiKorisnickaImena`,
            type: "POST",
            dataType: 'JSON',
            success: function (data) {
                label=document.getElementById("usernamelabel");
                var korime_input = document.getElementById('username').value;
                $.each(data, function (index, key) {
                    var korime = data[index].korisnicko_ime;
                    if (korime === korime_input) {
                        alert('Korisničko ime je zauzeto!');
                        istoKorime = 1;
                        regbutton.disabled = true;
                        label.style.color="red";
                        return false;

                    } else {
                        istoKorime = 0;
                        label.style.color="black";

                    }
                    });
                    if (greska_ime === 0 && greska_prezime === 0 && greska_username === 0 && istoKorime === 0 &&  greska_email === 0 && greska_password === 0 && greska_potvrda === 0) {
                        regbutton.disabled = false;
                        regbutton.style.backgroundColor = "black";
                    } else {
                        regbutton.disabled = true;
                        regbutton.style.backgroundColor = "red";
                    }

                }
            

        });
    });
});
 function provjeriCaptchu(){
        if (grecaptcha.getResponse() === ""){
                alert("Niste prošli CAPTCHA provjeru!");
                return false;
            }else{
                alert("Prošli ste CAPTCHA provjeru!");
                return true;
            }
    }
