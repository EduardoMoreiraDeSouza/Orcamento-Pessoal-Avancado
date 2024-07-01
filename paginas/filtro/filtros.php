<?php
if (!isset($_SESSION['ano_referencia']))
	$_SESSION['ano_referencia'] = '';
if (!isset($_SESSION['mes_referencia']))
	$_SESSION['mes_referencia'] = '';
if (!isset($_SESSION['codigo_variante']))
	$_SESSION['codigo_variante'] = '';

$_SESSION['codigo_variante'] = '';

// Set Ano de Referencia

if (isset($_POST['ano_referencia'])) {
	require_once __DIR__ . "/../../backEnd/gerais/FormatacaoDados.php";
	$formatarDados = new FormatacaoDados();
	$_SESSION['ano_referencia'] = $formatarDados -> fraseMinuscula($_POST['ano_referencia']);
}

else if ($_SESSION['ano_referencia'] == '')
	$_SESSION['ano_referencia'] = date('Y');

// Set Mes de Referencia

if (isset($_POST['mes_referencia'])) {
	$_SESSION['mes_referencia'] = $_POST['mes_referencia'];

	if ($_SESSION['mes_referencia'] != 'todos')
		if ($_SESSION['mes_referencia'] < 1 or $_SESSION['mes_referencia'] > 12)
			$_SESSION['mes_referencia'] = date('m');

}

else if ($_SESSION['mes_referencia'] == '')
	$_SESSION['mes_referencia'] = date('m');

if ($_SESSION['pagina_pai'] == 'bancosCorretoras' or $_SESSION['pagina_pai'] == 'credito') {
	if (gettype($_SESSION['ano_referencia']) != 'integer')
		$_SESSION['ano_referencia'] = date('Y');
	if (gettype($_SESSION['mes_referencia']) != 'integer')
		$_SESSION['mes_referencia'] = date('m');
}

if ($_SESSION['mes_referencia'] < 10)
	$_SESSION['mes_referencia'] = '0' . str_replace('0', '', $_SESSION['mes_referencia']);

/*******/

if (isset($_POST['filtrar_bancoCorretora']) and !empty($_POST['filtrar_bancoCorretora'])) {

	if ($_POST['filtrar_bancoCorretora'] == 'A-Z')
		$filtro = 'ASC';
	else
		$filtro = 'DESC';

	$_SESSION['codigo_variante'] = " ORDER BY bancoCorretora " . $filtro;
}

elseif (isset($_POST['filtrar_valor']) and !empty($_POST['filtrar_valor'])) {

	if ($_POST['filtrar_valor'] == 'Maior')
		$filtro = 'DESC';
	else
		$filtro = 'ASC';

	$_SESSION['codigo_variante'] = " ORDER BY valor " . $filtro;
}

elseif (isset($_POST['filtrar_limite']) and !empty($_POST['filtrar_limite'])) {

	if ($_POST['filtrar_limite'] == 'Maior')
		$filtro = 'DESC';
	else
		$filtro = 'ASC';

	$_SESSION['codigo_variante'] = " ORDER BY limite " . $filtro;
}

elseif (isset($_POST['filtrar_fechamento']) and !empty($_POST['filtrar_fechamento'])) {

	if ($_POST['filtrar_fechamento'] == 'Maior')
		$filtro = 'DESC';
	else
		$filtro = 'ASC';

	$_SESSION['codigo_variante'] = " ORDER BY fechamento " . $filtro;
}

elseif (isset($_POST['filtrar_vencimento']) and !empty($_POST['filtrar_vencimento'])) {

	if ($_POST['filtrar_vencimento'] == 'Maior')
		$filtro = 'DESC';
	else
		$filtro = 'ASC';

	$_SESSION['codigo_variante'] = " ORDER BY vencimento " . $filtro;
}

elseif (isset($_POST['filtrar_saldo']) and !empty($_POST['filtrar_saldo'])) {

	if ($_POST['filtrar_saldo'] == 'Maior')
		$filtro = 'DESC';
	else
		$filtro = 'ASC';

	$_SESSION['codigo_variante'] = " ORDER BY saldo " . $filtro;
}

elseif (isset($_POST['filtrar_classificacao']) and !empty($_POST['filtrar_classificacao'])) {
	if ($_POST['filtrar_classificacao'] == 'A-Z')
		$filtro = 'ASC';
	else
		$filtro = 'DESC';

	$_SESSION['codigo_variante'] = " ORDER BY classificacao " . $filtro;
}

elseif (isset($_POST['filtrar_parcelas']) and !empty($_POST['filtrar_parcelas'])) {
	if ($_POST['filtrar_parcelas'] == 'Maior')
		$filtro = 'DESC';
	else
		$filtro = 'ASC';

	$_SESSION['codigo_variante'] = " ORDER BY parcelas " . $filtro;
}

elseif (isset($_POST['filtrar_data']) and !empty($_POST['filtrar_data'])) {
	if ($_POST['filtrar_data'] == 'Novos')
		$filtro = 'ASC';
	else
		$filtro = 'DESC';

	$_SESSION['codigo_variante'] = " ORDER BY dataCompraPagamento " . $filtro;
}

elseif (isset($_POST['filtrar_forma_pagamento']) and !empty($_POST['filtrar_forma_pagamento'])) {
	if ($_POST['filtrar_forma_pagamento'] == 'A-Z')
		$filtro = 'ASC';
	else
		$filtro = 'DESC';

	$_SESSION['codigo_variante'] = " ORDER BY formaPagamento " . $filtro;
}