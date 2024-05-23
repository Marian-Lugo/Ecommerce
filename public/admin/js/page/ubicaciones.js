const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const titleModal = document.querySelector("#titleModal");
const btnAccion = document.querySelector("#btnAccion");
let tblUbicaciones;

const myModal = new bootstrap.Modal(document.getElementById("nuevoModal"));

document.addEventListener("DOMContentLoaded", function () {
    tblUbicaciones = $("#tblUbicaciones").DataTable({
        ajax: {
            url: base_url + "ubicaciones/listar",
            dataSrc: "",
        },
        columns: [
            { data: "id_ubicacion" },
            { data: "manzana" },
            { data: "sector" },
            { data: "nombre_extinto" },
            { data: "descripcion" },
            { data: "accion" },
        ],
        responsive: true,
        language,
        dom: "Bfrtip",
        buttons,
        order: [[0, "desc"]],
    });

    // Levantar modal
    nuevo.addEventListener("click", function () {
        document.querySelector("#id").value = "";
        titleModal.textContent = "NUEVA UBICACIÓN";
        btnAccion.textContent = "Registrar";
        frm.reset();
        myModal.show();
    });

    // Submit ubicaciones
    frm.addEventListener("submit", function (e) {
        e.preventDefault();
        let data = new FormData(this);
        const url = base_url + "ubicaciones/registrar";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(data);
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                let type = res.icono == "success" ? 1 : 2;
                alertas(res.msg.toUpperCase(), type);
                if (res.icono == "success") {
                    frm.reset();
                    tblUbicaciones.ajax.reload();
                    myModal.hide();
                }
            }
        };
    });
});

function eliminarUbicacion(idUbicacion) {
    Swal.fire({
        title: "Aviso",
        text: "¿Está seguro de eliminar el registro?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "ubicaciones/delete/" + idUbicacion;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono == "success") {
                        tblUbicaciones.ajax.reload();
                    }
                    let type = res.icono == "success" ? 1 : 2;
                    alertas(res.msg.toUpperCase(), type);
                }
            };
        }
    });
}

function editUbicacion(idUbicacion) {
    const url = base_url + "ubicaciones/edit/" + idUbicacion;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.querySelector("#id").value = res.id_ubicacion;
            document.querySelector("#id_manzana").value = res.id_manzana;
            document.querySelector("#id_sector").value = res.id_sector;
            document.querySelector("#nombre_extinto").value = res.nombre_extinto;
            document.querySelector("#descripcion").value = res.descripcion;
            btnAccion.textContent = "Actualizar";
            myModal.show();
        }
    };
}
