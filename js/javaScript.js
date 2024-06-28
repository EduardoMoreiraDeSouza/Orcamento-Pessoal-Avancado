function setMinHeight() {

    const altura = document.querySelector('table').clientHeight;
    const banner = document.getElementById('banner');
    const novaAltura = altura / 10 * 2.5;

    if (novaAltura > 100)
        banner.style.height = `${novaAltura}vh`;
    else
        banner.style.height = `100vh`;

}