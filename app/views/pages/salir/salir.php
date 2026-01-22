<?php
// 1. Destruimos todas las variables de sesión
session_destroy();

// 2. Redirigimos al login de forma limpia usando JavaScript
echo '<script>
    window.location = "login";
</script>';
