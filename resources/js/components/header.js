// Header functionality
$(document).ready(function () {
    // User dropdown menu functionality
    $("#userMenuButton").click(function (e) {
        e.stopPropagation();
        $("#userDropdown").toggleClass("hidden");
        $("#userMenuChevron").toggleClass("rotate-180");
    });

    // Close dropdown when clicking outside
    $(document).click(function () {
        $("#userDropdown").addClass("hidden");
        $("#userMenuChevron").removeClass("rotate-180");
    });

    // Prevent dropdown from closing when clicking inside it
    $("#userDropdown").click(function (e) {
        e.stopPropagation();
    });
});
