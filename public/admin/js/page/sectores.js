const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const titleModal = document.querySelector("#titleModal");
const btnAccion = document.querySelector("#btnAccion");

let tblSectores;

const myModal = new bootstrap.Modal(document.getElementById("nuevoModal"));

document.addEventListener("DOMContentLoaded", function () {
  tblSectores = $("#tblSectores").DataTable({
    ajax: {
      url: base_url + "sectores/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_sector" },
      { data: "descripcion" },
      { data: "manzana_descripcion" },
      { data: "accion" },
    ],
    responsive: true,
    language,
    dom: "Bfrtip",
    buttons,
    order: [[0, "desc"]],
  });

  // Abrir modal para nuevo registro
  nuevo.addEventListener("click", function () {
    document.querySelector("#id").value = "";
    titleModal.textContent = "NUEVO SECTOR";
    btnAccion.textContent = "Registrar";
    frm.reset();
    myModal.show();
  });

  // Enviar formulario
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "sectores/registrar";
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
          tblSectores.ajax.reload();
          myModal.hide();
        }
      }
    };
  });
});

function eliminarSector(idSector) {
  Swal.fire({
    title: "Aviso?",
    text: "¿Está seguro de eliminar el registro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, Eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "sectores/delete/" + idSector;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tblSectores.ajax.reload();
          }
          let type = res.icono == "success" ? 1 : 2;
          alertas(res.msg.toUpperCase(), type);
        }
      };
    }
  });
}

function editSector(idSector) {
  const url = base_url + "sectores/edit/" + idSector;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      document.querySelector("#id").value = res.id_sector;
      document.querySelector("#descripcion").value = res.descripcion;
      document.querySelector("#id_manzana").value = res.id_manzana;
      btnAccion.textContent = "Actualizar";
      titleModal.textContent = "EDITAR SECTOR";
      myModal.show();
    }
  };
}
