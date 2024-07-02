<?php

$nomes_bancos_corretoras_select = new ExecucaoCodigoMySql();
$nomes_bancos_corretoras_select -> setCodigoMySql(
	"SELECT * FROM dbName.bancosCorretoras WHERE email LIKE '" . $nomes_bancos_corretoras_select -> getSessao() . "';"
);
$resultadoExecucao2 = $nomes_bancos_corretoras_select -> ExecutarCodigoMySql();

while ($dados_bancos_corretoras_select = mysqli_fetch_assoc($resultadoExecucao2)) {

	$bancoCorretora = $dados_bancos_corretoras_select['bancoCorretora'];

	?>

	<option value="<?= $dados_bancos_corretoras_select['id'] ?>" <?= $dados_bancos_corretoras_select['id'] == $dados['id_bancoCorretora'] ? 'selected' : '' ?>><?= $bancoCorretora ?></option>


<?php } ?>
