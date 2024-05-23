const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const titleModal = document.querySelector("#titleModal");
const descripcion = document.querySelector("#descripcion");
const btnAccion = document.querySelector("#btnAccion");
const myModal = new bootstrap.Modal(document.getElementById("nuevoModal"));

let tblManzanas;
document.addEventListener("DOMContentLoaded", function () {
    tblManzanas = $("#tblManzanas").DataTable({
        ajax: {
            url: base_url + "manzanas/listar",
            dataSrc: "",
        },
        columns: [
            { data: "id_manzana" },
            { data: "descripcion" },
            { data: "accion" }
        ],
        language,
        dom: 'Bfrtip',
        buttons,
    });

    // Levantar modal para nueva manzana
    nuevo.addEventListener("click", function () {
        document.querySelector('#id').value = '';
        titleModal.textContent = "NUEVA MANZANA";
        btnAccion.textContent = 'Registrar';
        frm.reset();
        myModal.show();
    });

    // Submit manzanas
    frm.addEventListener("submit", function (e) {
        e.preventDefault();
        if (descripcion.value == '') {
            alertas('LA DESCRIPCIÓN ES REQUERIDA', 2);
        } else {
            let data = new FormData(this);
            const url = base_url + "manzanas/registrar";
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res.icono == "success") {
                        myModal.hide();
                        tblManzanas.ajax.reload();
                    }
                    let type = (res.icono == "success") ? 1 : 2;
                    alertas(res.msg.toUpperCase(), type);
                }
            }
        }
    });
});

function eliminarManzana(idManzana) {
    Swal.fire({
        title: "Aviso?",
        text: "Está seguro de eliminar el registro!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, Eliminar!",
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "manzanas/delete/" + idManzana;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res.icono == "success") {
                        tblManzanas.ajax.reload();
                    }
                    let type = (res.icono == "success") ? 1 : 2;
                    alertas(res.msg.toUpperCase(), type);
                }
            }
        }
    });
}

function editManzana(idManzana) {
    const url = base_url + "manzanas/edit/" + idManzana;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.querySelector('#id').value = res.id_manzana;
            document.querySelector('#descripcion').value = res.descripcion;
            btnAccion.textContent = 'Actualizar';
            titleModal.textContent = "MODIFICAR MANZANA";
            myModal.show();
        }
    }
}
