// Sidebar functionality
$(document).ready(function () {
    // Mobile sidebar toggle - VERSIÓN FINAL
    $("#sidebarToggle").click(function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $sidebar = $("#sidebar");
        const $overlay = $("#sidebarOverlay");

        // Toggle sidebar visibility
        $sidebar.toggleClass("-translate-x-full");

        // Manejar overlay correctamente
        if ($sidebar.hasClass("-translate-x-full")) {
            // Sidebar cerrado - ocultar overlay
            $overlay.addClass("hidden").hide();
            $("body").removeClass("overflow-hidden");
        } else {
            // Sidebar abierto - mostrar overlay solo en móvil
            if ($(window).width() < 1024) {
                $overlay.removeClass("hidden").show();
                $("body").addClass("overflow-hidden");
            }
        }
    });

    // Close sidebar when clicking overlay
    $("#sidebarOverlay").click(function () {
        $("#sidebar").addClass("-translate-x-full");
        $("#sidebarOverlay").addClass("hidden").hide();
        $("body").removeClass("overflow-hidden");
    });

    // Close sidebar on window resize to desktop
    $(window).resize(function () {
        if ($(window).width() >= 1024) {
            $("#sidebar").removeClass("-translate-x-full");
            $("#sidebarOverlay").addClass("hidden").hide();
            $("body").removeClass("overflow-hidden");
        }
    });

    // Asegurar estado inicial correcto
    $(window).on("load", function () {
        if ($(window).width() < 1024) {
            $("#sidebar").addClass("-translate-x-full");
        }
        $("#sidebarOverlay").addClass("hidden").hide();
    });

    // Add active state to current page
    const currentPath = window.location.pathname;
    $(".nav-item").each(function () {
        if ($(this).attr("href") === currentPath) {
            $(this).addClass(
                "bg-blue-600/20 text-blue-400 border-r-2 border-blue-400"
            );
            $(this).find("i").addClass("text-blue-400");
        }
    });

    $("#sidebarClose").click(function () {
        $("#sidebar").addClass("-translate-x-full");
        $("#sidebarOverlay").addClass("hidden");
        $("body").removeClass("overflow-hidden");
    });
});
