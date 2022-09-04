setTimeout(function loadfun() {
    var fadeTarget = document.getElementById("loading");
    var fadeEffect = setInterval(function () {
        if (!fadeTarget.style.opacity) {
            fadeTarget.style.opacity = 1;
        }
        if (fadeTarget.style.opacity > 0) {
            fadeTarget.style.opacity -= 0.01;
        } else {
            clearInterval(fadeEffect);
            fadeTarget.style.opacity = '';
            fadeTarget.style.display = 'none';
        }
    }, 2);
}, 200);