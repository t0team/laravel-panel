window.toggleSidebar = (dir) => {
    const sidebar = document.getElementById("sidebar");
    const sbShadow = document.getElementById("sb-shadow");

    if (dir == 'rtl') dir = 'right'; else dir = 'left';

    if (sidebar.style[dir] == "-280px") {
        sidebar.style[dir] = "0px";
        sbShadow.style.display = "block";
    } else {
        sidebar.style[dir] = "-280px";
        sbShadow.style.display = "none";
    }
}