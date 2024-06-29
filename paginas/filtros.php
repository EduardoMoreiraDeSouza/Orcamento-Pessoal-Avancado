<?php

if (!isset($_SESSION['ano_referencia']))
    $_SESSION['ano_referencia'] = '';
if (!isset($_SESSION['mes_referencia']))
    $_SESSION['mes_referencia'] = '';
if (!isset($_SESSION['codigoVariante']))
    $_SESSION['codigoVariante'] = '';

// Set Ano de Referencia

if (isset($_GET['ano_referencia']))
    $anoReferencia = $_GET['ano_referencia'];
else
    if ($_SESSION['ano_referencia'] == '')
        $anoReferencia = intval(date('Y'));
    else
        $anoReferencia = $_SESSION['ano_referencia'];

// Set Mes de Referencia

if (isset($_GET['mes_referencia'])) {
    $mesReferencia = $_GET['mes_referencia'];

    if ($mesReferencia != 'todos')
        if ($mesReferencia < 1 or $mesReferencia > 12)
            $mesReferencia = intval(date('m'));

} else
    if ($_SESSION['mes_referencia'] == '')
        $mesReferencia = intval(date('m'));
    else
        $mesReferencia = $_SESSION['mes_referencia'];


$_SESSION['ano_referencia'] = $anoReferencia;
$_SESSION['mes_referencia'] = $mesReferencia;

/*******/

if (isset($_GET['filtrar_bancoCorretora']) and !empty($_GET['filtrar_bancoCorretora'])) {

    if ($_GET['filtrar_bancoCorretora'] == 'A-Z')
        $filtro = 'ASC';
    else
        $filtro = 'DESC';

    $codigoVariante = " ORDER BY bancoCorretora " . $filtro;
}

elseif (isset($_GET['filtrar_valor']) and !empty($_GET['filtrar_valor'])) {

    if ($_GET['filtrar_valor'] == 'Maior')
        $filtro = 'DESC';
    else
        $filtro = 'ASC';

    $codigoVariante = " ORDER BY valor " . $filtro;
}

elseif (isset($_GET['filtrar_classificacao']) and !empty($_GET['filtrar_classificacao'])) {
    if ($_GET['filtrar_classificacao'] == 'A-Z')
        $filtro = 'ASC';
    else
        $filtro = 'DESC';

    $codigoVariante = " ORDER BY classificacao " . $filtro;
}

elseif (isset($_GET['filtrar_parcelas']) and !empty($_GET['filtrar_parcelas'])) {
    if ($_GET['filtrar_parcelas'] == 'Maior')
        $filtro = 'DESC';
    else
        $filtro = 'ASC';

    $codigoVariante = " ORDER BY parcelas " . $filtro;
}

elseif (isset($_GET['filtrar_data']) and !empty($_GET['filtrar_data'])) {
    if ($_GET['filtrar_data'] == 'Novos')
        $filtro = 'ASC';
    else
        $filtro = 'DESC';

    $codigoVariante = " ORDER BY dataCompraPagamento " . $filtro;
}

if (isset($codigoVariante) and !empty($codigoVariante))
    $_SESSION['codigoVariante'] = $codigoVariante;
else
    $codigoVariante = $_SESSION['codigoVariante'];