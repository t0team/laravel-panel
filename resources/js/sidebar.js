window.toggleSidebar = () => {
    const sidebar = document.getElementById("sidebar");
    const sbShadow = document.getElementById("sb-shadow");
    if (sidebar.style.right == "-280px") {
        sidebar.style.right = "0px";
        sbShadow.style.display = "block";
    } else {
        sidebar.style.right = "-280px";
        sbShadow.style.display = "none";
    }
}