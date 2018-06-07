var getLocation = function(href) {
    var l = document.createElement("a");
    l.href = href;
    return l;
};
let url = getLocation(window.location.href);
url = url.pathname; // A changer sur le serveur enlever le www sur chaque séléction
console.log(url);
/*==============================
        Profil nounou
================================ */


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
if (url === "/www/parent/enregistrement-profil.php") {
    let btnAjoutEnfant = document.getElementById('btnajout');

    btnAjoutEnfant.addEventListener('click', function () {
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
    });
}
/*==============================
    Ajout langue
================================ */
if (url === "/www/nounou/enregistrement-profil.php") {
    let btnAjoutLangue = document.getElementById('btnajoutlangue');
    btnAjoutLangue.addEventListener('click', function () {
        let nb = document.getElementById('nblangue').value;
        let message = "";
        message += '<label>Langue :</label>';
        message += '<input name="langue[]" type="text" class="form-control">';
        var i;
        for (i = 0; i < nb; i++) {
            var champAjout = document.getElementById("ajoutlangue");
            champAjout.innerHTML += message;
        }
    });
}

