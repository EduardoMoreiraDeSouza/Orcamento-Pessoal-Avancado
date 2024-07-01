function setMinHeight() {

    let alturaSection = document.querySelector('div.introducao').offsetHeight;
    let alturaTabela = document.querySelector('table').offsetHeight;
    let banner = document.getElementById('banner');
    let complemento = 0;

    alturaSection = alturaSection / 100 * 10;
    alturaTabela = alturaTabela / 100 * 10;

    let novaAltura = alturaTabela + alturaSection + 10
    if (novaAltura < 180) complemento = 10

    if (novaAltura > 100)
        banner.style.height = `${novaAltura}vh`;
    else
        banner.style.height = `100vh`;
}