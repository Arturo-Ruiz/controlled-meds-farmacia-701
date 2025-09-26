$(document).ready(function () {
    // Auto-focus en email
    $("#email").focus();

    // Toggle mostrar/ocultar contraseña - SOLUCIÓN MEJORADA
    $("#togglePassword").on("click", function (e) {
        e.preventDefault();

        const passwordField = $("#password");
        const currentType = passwordField.attr("type");

        if (currentType === "password") {
            // Mostrar contraseña
            passwordField.attr("type", "text");
            $(this).html('<i class="fas fa-eye-slash"></i>');
            $(this).attr("aria-label", "Ocultar contraseña");
        } else {
            // Ocultar contraseña
            passwordField.attr("type", "password");
            $(this).html('<i class="fas fa-eye"></i>');
            $(this).attr("aria-label", "Mostrar contraseña");
        }
    });

    // Navegación con Enter
    $("#email").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $("#password").focus();
        }
    });

    $("#password").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $("#loginForm").submit();
        }
    });

    // Estado de carga del formulario
    $("#loginForm").on("submit", function () {
        const btn = $("#loginBtn");
        const btnText = $("#btnText");
        const btnLoading = $("#btnLoading");

        btn.prop("disabled", true);
        btnText.addClass("hidden");
        btnLoading.removeClass("hidden");

        // Timeout de seguridad para re-habilitar
        setTimeout(function () {
            btn.prop("disabled", false);
            btnText.removeClass("hidden");
            btnLoading.addClass("hidden");
        }, 10000);
    });
});
