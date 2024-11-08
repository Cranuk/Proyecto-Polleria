window.addEventListener('load', function(){
    const body = $("body");
    const modeToggle = $(".mode-toggle");
    const sidebar = $("nav");
    const sidebarToggle = $(".sidebar-toggle");

    // Verificar y aplicar el modo guardado
    const getMode = localStorage.getItem("mode");
    if (getMode && getMode === "dark") {
        body.toggleClass("dark");
    }

    // Verificar y aplicar el estado de la barra lateral
    const getStatus = localStorage.getItem("status");
    if (getStatus && getStatus === "close") {
        sidebar.toggleClass("close");
    }

    // Manejar el cambio de modo
    modeToggle.on("click", function() {
        body.toggleClass("dark");
        if (body.hasClass("dark")) {
            localStorage.setItem("mode", "dark");
        } else {
            localStorage.setItem("mode", "light");
        }
    });

    // Manejar el estado de la barra lateral
    sidebarToggle.on("click", function() {
        sidebar.toggleClass("close");
        if (sidebar.hasClass("close")) {
            localStorage.setItem("status", "close");
        } else {
            localStorage.setItem("status", "open");
        }
    });
});