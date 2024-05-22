const nuevoManzana = document.querySelector("#nuevo_registro_manzana");
const frmManzana = document.querySelector("#frmRegistroManzana");
const titleModalManzana = document.querySelector("#titleModalManzana");
const descripcionManzana = document.querySelector("#descripcion_manzana");
const btnAccionManzana = document.querySelector("#btnAccionManzana");
const myModalManzana = new bootstrap.Modal(document.getElementById("nuevoModalManzana"));

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

    //levantar modal
    nuevoManzana.addEventListener("click", function () {
        document.querySelector('#id_manzana').value = '';
        titleModalManzana.textContent = "NUEVA MANZANA";
        btnAccionManzana.textContent = 'Registrar';
        frmManzana.reset();
        myModalManzana.show();
    });

    //submit manzanas
    frmManzana.addEventListener("submit", function (e) {
        e.preventDefault();
        if (descripcionManzana.value == '') {
            alertas('La descripción es requerida', 2);
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
                        myModalManzana.hide();
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

function editarManzana(idManzana) {
    const url = base_url + "manzanas/edit/" + idManzana;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.querySelector('#id_manzana').value = res.id_manzana;
            document.querySelector('#descripcion_manzana').value = res.descripcion;
            btnAccionManzana.textContent = 'Actualizar';
            titleModalManzana.textContent = "MODIFICAR MANZANA";
            myModalManzana.show();
        }
    }
}
