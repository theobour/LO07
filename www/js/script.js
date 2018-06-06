
/*==============================
        Profil nounou
================================ */

function test () {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("test").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "creation-planning.php?year=2018&month=5", true);
    xhttp.send();
}

function modification (id) {
    id = id.concat("1");
    console.log(id);
    let elt = document.getElementById(id);
    let btn = "<button type='button' id='" + id + "'>test</button>";
    let input = " <input name='" + id + "' type='text'>";
    elt.innerHTML = input.concat(btn);
}

/*==============================
        Ajout enfant
================================ */
    let btnAjout = document.getElementById('btnajout');

    btnAjout.addEventListener('click', function () {
        let nb = document.getElementById('nbenfant').value;
        let message = "";
        message += '<label>Prénom de l\'enfant :</label>';
        message += '<input name="prenomenfant[]" type="text" class="form-control">';
        message += '<label>Age de l\'enfant :</label>';
        message += '<input name="ageenfant[]" type="text" class="form-control">';
        message += '<label>Information importante :</label>';
        message += '<input name="informationenfant[]" type="text" class="form-control">';
        var i;
        for (i = 0; i < nb; i++) {
            var champAjout = document.getElementById("ajoutenfant");
            champAjout.innerHTML += message;
        }

        console.log("a");
    });

