<?php

$nomes_cartoes_credito = new ExecucaoCodigoMySql();
$nomes_cartoes_credito -> setCodigoMySql(
	"SELECT * FROM dbName.cartoesCredito WHERE email LIKE '" . $nomes_cartoes_credito -> getSessao() . "';"
);
$resultadoExecucao_nomes_cartoes_credito = $nomes_cartoes_credito -> ExecutarCodigoMySql();
$bancoCorretora = new ObterDadosBancosCorretoras();

while ($dados_nomes_cartoes_credito = mysqli_fetch_assoc($resultadoExecucao_nomes_cartoes_credito)) {

	$nomeCartaoCredito = $bancoCorretora -> ObterDadosBancosCorretoras(
		$dados_nomes_cartoes_credito['id_bancoCorretora'], null
	)[0]['bancoCorretora'];

	?>

	<option value="<?= $dados_nomes_cartoes_credito['id_bancoCorretora'] ?>"><?= $nomeCartaoCredito ?></option>

<?php } ?>