document.addEventListener("DOMContentLoaded", function () {
    let pasoActual = 1;
    const form = document.getElementById("formularioMadurez");

    // Si no encuentra el formulario en esta página, no ejecuta el resto para evitar errores
    if (!form) return;

    const paginas = document.querySelectorAll(".pagina-encuesta");
    const totalPasos = paginas.length;

    const btnSiguiente = document.getElementById("btnSiguiente");
    const btnAnterior = document.getElementById("btnAnterior");
    const btnSubmit = document.getElementById("btnSubmit");
    const progressBar = document.getElementById("progressBar");
    const progresoTexto = document.getElementById("progresoTexto");

    // 1. Captura de datos de Radios (Corregido para manejar nulos)
    form.addEventListener("change", function (event) {
        if (event.target.type === "radio") {
            const nameAttr = event.target.name;
            const match = nameAttr.match(/\[(\d+)\]/);

            if (match) {
                const idPregunta = match[1];
                const txtInput = document.getElementById("txt_" + idPregunta);
                const valInput = document.getElementById("val_" + idPregunta);

                if (txtInput)
                    txtInput.value =
                        event.target.getAttribute("data-texto") || "";
                if (valInput)
                    valInput.value =
                        event.target.getAttribute("data-valor") || "";
            }

            // Ocultar mensaje de error al seleccionar
            const grupo = event.target.closest(".grupo-opciones");
            if (grupo) {
                const feedback = grupo.querySelector(".invalid-feedback");
                if (feedback) feedback.style.display = "none";
            }
        }
    });

    // 2. Función de Validación (Ajustada para campos opcionales)
    function validarPasoActual() {
        const pasoVisible = document.getElementById("paso-" + pasoActual);
        if (!pasoVisible) return false;

        const gruposRadio = pasoVisible.querySelectorAll(".grupo-opciones");
        // Solo validamos textareas que tengan el atributo 'required'
        const textareasRequired =
            pasoVisible.querySelectorAll("textarea[required]");
        let esValido = true;

        // Validar Radios
        gruposRadio.forEach((grupo) => {
            const radios = grupo.querySelectorAll('input[type="radio"]');
            const feedback = grupo.querySelector(".invalid-feedback");
            const seleccionado = Array.from(radios).some((r) => r.checked);

            if (!seleccionado) {
                esValido = false;
                if (feedback) feedback.style.display = "block";
            } else {
                if (feedback) feedback.style.display = "none";
            }
        });

        // Validar Textareas obligatorios
        textareasRequired.forEach((area) => {
            if (!area.value.trim()) {
                esValido = false;
                area.classList.add("is-invalid");
            } else {
                area.classList.remove("is-invalid");
            }
        });

        return esValido;
    }

    // 3. Navegación e Interfaz
    function actualizarInterfaz() {
        paginas.forEach((p, i) => {
            p.classList.toggle("d-none", i + 1 !== pasoActual);
        });

        const porcentaje = (pasoActual / totalPasos) * 100;
        if (progressBar) progressBar.style.width = porcentaje + "%";
        if (progresoTexto)
            progresoTexto.innerText = `Paso ${pasoActual} de ${totalPasos}`;

        if (btnAnterior)
            btnAnterior.classList.toggle("d-none", pasoActual === 1);

        if (pasoActual === totalPasos) {
            if (btnSiguiente) btnSiguiente.classList.add("d-none");
            if (btnSubmit) btnSubmit.classList.remove("d-none");
        } else {
            if (btnSiguiente) btnSiguiente.classList.remove("d-none");
            if (btnSubmit) btnSubmit.classList.add("d-none");
        }

        window.scrollTo({ top: 0, behavior: "smooth" });
    }

    // 4. Eventos de Botones
    if (btnSiguiente) {
        btnSiguiente.addEventListener("click", () => {
            if (validarPasoActual()) {
                pasoActual++;
                actualizarInterfaz();
            }
        });
    }

    if (btnAnterior) {
        btnAnterior.addEventListener("click", () => {
            if (pasoActual > 1) {
                pasoActual--;
                actualizarInterfaz();
            }
        });
    }

    // 5. Envío del Formulario
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        if (validarPasoActual()) {
            enviarFormularioAjax();
        }
    });

    function enviarFormularioAjax() {
        const datos = new FormData(form);
        $.ajax({
            url: "app/ajax/respuestas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                if (btnSubmit) {
                    btnSubmit.disabled = true;
                    btnSubmit.innerHTML =
                        '<span class="spinner-border spinner-border-sm"></span> Enviando...';
                }
            },
            success: function (respuesta) {
                // Limpiamos la respuesta de posibles espacios o errores de PHP
                if (respuesta.trim() === "ok") {
                    Swal.fire({
                        title: "¡Éxito!",
                        text: "Evaluación registrada correctamente.",
                        icon: "success",
                        confirmButtonText: "Aceptar",
                    }).then(() => {
                        window.location = "inicio";
                    });
                } else {
                    Swal.fire(
                        "Error",
                        "No se pudo guardar: " + respuesta,
                        "error",
                    );
                    if (btnSubmit) {
                        btnSubmit.disabled = false;
                        btnSubmit.innerHTML =
                            '<i class="fas fa-paper-plane mr-2"></i> Enviar Formulario';
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                Swal.fire(
                    "Error de Red",
                    "No se pudo contactar con el servidor.",
                    "error",
                );
                if (btnSubmit) {
                    btnSubmit.disabled = false;
                    btnSubmit.innerHTML = "Enviar Formulario";
                }
            },
        });
    }

    actualizarInterfaz();
});
