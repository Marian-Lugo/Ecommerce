const frmBuscar = document.querySelector("#buscarForm");

frmBuscar.addEventListener("submit", function (e) {
    e.preventDefault();
    const nombreExtinto = document.querySelector("#nombre").value;
    if (nombreExtinto.trim() !== "") {
        buscarExtinto(nombreExtinto);
    } else {
        alert("Por favor ingrese un nombre de extinto.");
    }
});

function buscarExtinto(nombreExtinto) {
    const url = base_url + "ubicaciones/ubicacionPorNombre/" + nombreExtinto;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            // Manejar los datos devueltos, por ejemplo, mostrarlos en el DOM
            console.log(data);
            // Aquí puedes manejar cómo deseas mostrar los resultados en la vista
        })
        .catch(error => console.error('Error al buscar extinto:', error));
}
