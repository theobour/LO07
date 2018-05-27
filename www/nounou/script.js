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