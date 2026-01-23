/*-- --------------------------
* FUNCION GENÉRICA PARA VER/OCULTAR PASSWORD
-------------------------------*/
function mostrarPassword(idInput, idIcono) {
    var x = document.getElementById(idInput);
    var icono = document.getElementById(idIcono);

    // Verificamos que ambos existan para evitar errores en consola
    if (!x || !icono) return;

    var boton = icono.closest("button");

    if (x.type === "password") {
        x.type = "text";
        icono.classList.replace("fa-eye", "fa-eye-slash");
        if (boton) boton.classList.replace("btn-primary", "btn-info");
    } else {
        x.type = "password";
        icono.classList.replace("fa-eye-slash", "fa-eye");
        if (boton) boton.classList.replace("btn-info", "btn-primary");
    }
}
