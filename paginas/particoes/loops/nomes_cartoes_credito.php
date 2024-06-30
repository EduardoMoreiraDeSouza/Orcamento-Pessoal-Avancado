<?php

$nomes_bancos_corretoras = new ExecucaoCodigoMySql();
$nomes_bancos_corretoras->setCodigoMySql("SELECT * FROM dbName.cartoesCredito WHERE email LIKE '" . $nomes_bancos_corretoras->getSessao() . "';");
$resultadoExecucao = $nomes_bancos_corretoras->ExecutarCodigoMySql();

while ($dados_nomes_bancos_corretoras = mysqli_fetch_assoc($resultadoExecucao)) {
    $nomeCartaoCredito = $dados_nomes_bancos_corretoras['bancoCorretora'];

    ?>

	<option value="<?= $dados_nomes_bancos_corretoras['id'] ?>"><?= $nomeCartaoCredito ?></option>


<?php } ?>