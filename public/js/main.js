$(document).ready(iniciarEventos);

var internal_url_private = "../private/index.php";
var internal_url = "../private/contenido.php";

async function iniciarEventos() {
  console.log("inicio");
  consultarContenido();
  registrarContacto();
  eliminarContacto();
  FitrarContactos();

  return 1;
}

function consultarContenido() {
  $("body").on("click", ".traer-contenido", function () {
    var elemento = $(this);
    var atr_contenido = elemento.attr("contenido");
    var titulo_general = elemento.attr("titulo_general");
    var contenedor = $(".card-body");
    var contenedor_titulo = $(".card-title");
    var id_select = elemento.attr("id");

    if (!(typeof id_select !== "undefined" && id_select !== false)) {
      id_select = "";
    }

    if (!(typeof titulo_general !== "undefined" && titulo_general !== false)) {
      titulo_general = "SIN TITULO";
    }

    $.ajax({
      method: "POST",
      url: internal_url_private,
      data: {
        action: "consultar-contenido",
        atr_contenido: atr_contenido,
        titulo_general: titulo_general,
        id_select: id_select,
      },
      dataType: "json",
      beforeSend: function () {},
      success: async function (data) {
        var code = data.code;
        var titulo = data.titulo;
        var html = decodeURIComponent(data.html);
        if (code === "200") {
          contenedor.html(html);
          contenedor_titulo.html(titulo);
        } else {
          contenedor.html(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> No se pudo traer el contenido.
            </div>
        `);
          contenedor_titulo.html(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong> No se pudo traer el titulo.
            </div>
        `);
        }
        return 2;
      },
    });
  });
}

function registrarContacto() {
  $("body").on("click", ".ingresarContacto", function () {
    let contacto_nombre = document.getElementById("contacto_nombre").value;
    let contacto_correo = document.getElementById("contacto_correo").value;
    let contacto_telefono = document.getElementById("contacto_telefono").value;

    let formData = new FormData();
    formData.append("action", "ingresarContacto");
    formData.append("contacto_nombre", contacto_nombre);
    formData.append("contacto_correo", contacto_correo);
    formData.append("contacto_telefono", contacto_telefono);

    $.ajax({
      method: "POST",
      url: internal_url,
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      beforeSend: function () {},
      success: async function (data) {
        var code = data.code;
        var mensaje = data.message;
        if (code === "200") {
          alertify.set("notifier", "position", "top-center");
          alertify.success(mensaje, 10);
        } else {
          alertify.set("notifier", "position", "top-center");
          alertify.error(mensaje, 10);
        }
        return 2;
      },
    });
  });
}

function eliminarContacto() {
  $("body").on("click", ".eliminar_contacto", function () {
    let id_contacto = $(this).attr("atr_id");
    let formData = new FormData();
    formData.append("action", "eliminarContacto");
    formData.append("contacto_id", id_contacto);

    $.ajax({
      method: "POST",
      url: internal_url,
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      beforeSend: function () {},
      success: async function (data) {
        var code = data.code;
        var mensaje = data.message;
        if (code === "200") {
          alertify.set("notifier", "position", "top-center");
          alertify.success(mensaje, 10);
          $('.traer-contenido[contenido="listar_contactos"]').trigger("click");
        } else {
          alertify.set("notifier", "position", "top-center");
          alertify.error(mensaje, 10);
        }
        return 2;
      },
    });
  });
}

function FitrarContactos() {
  $("body").on("click", "#completar_filtro", function () {
    let contacto_nombre = document.getElementById("contacto_nombre").value;
    let contacto_telefono = document.getElementById("contacto_telefono").value;
    var contenedor = $(".card-body");

    let formData = new FormData();
    formData.append("action", "filtrarContactos");
    formData.append("contacto_nombre", contacto_nombre);
    formData.append("contacto_telefono", contacto_telefono);

    $.ajax({
      method: "POST",
      url: internal_url,
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      beforeSend: function () {
        $(".btn-close").trigger("click");
      },
      success: async function (data) {
        console.log(data);
        var code = data.code;
        var mensaje = data.message;
        var html = decodeURIComponent(data.html);
        if (code === "200") {
          alertify.set("notifier", "position", "top-center");
          alertify.success(mensaje, 10);
          contenedor.html(html);
        } else {
          alertify.set("notifier", "position", "top-center");
          alertify.error(mensaje, 10);
        }
        return 2;
      },
    });
  });
}
