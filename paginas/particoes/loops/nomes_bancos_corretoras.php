<?php

$nomes_banco_corretoras = new ExecucaoCodigoMySql();
$nomes_banco_corretoras->setCodigoMySql("SELECT * FROM dbName.bancosCorretoras WHERE email LIKE '" . $nomes_banco_corretoras->getSessao() . "';");
$resultadoExecucao = $nomes_banco_corretoras->ExecutarCodigoMySql();

while ($dados_nomes_bancos_corretoras = mysqli_fetch_assoc($resultadoExecucao)) {
    $bancoCorretora = $dados_nomes_bancos_corretoras['bancoCorretora'];

	?>

	<option value="<?= $dados_nomes_bancos_corretoras['id'] ?>"><?= $bancoCorretora ?></option>

<?php } ?>

