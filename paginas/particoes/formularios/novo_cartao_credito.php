<div class="col-auto">

    <p>
        <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                data-bs-target="#novoCartaoCredito" aria-expanded="false"
                aria-controls="collapseWidthExample">
            Novo Cartão de Crédito
        </button>
    </p>

    <div style="min-height: auto;" class="mb-4">

        <div class="collapse collapse-horizontal" id="novoCartaoCredito">

            <div class="card card-body border border-dark bg-secondary"
                 style="width: 100%;">

                <form action="../backEnd/InteracaoFront/novoCartaoCredito.php"
                      method="POST"
                      class="form hstack gap-3">

                    <select class="form-select" name="bancoCorretora" required>

                        <option value="" selected> Banco | Corretora</option>
                        <?php include(__DIR__ . '/../loops/nomes_bancos_corretoras.php') ?>

                    </select>

                    <input type="number" class="container input-group-text" name="valor"
                           placeholder="Limite:" step="0.01" required>
                    <input type="number" class="container input-group-text"
                           name="fechamento"
                           placeholder="fechamento" max="31" min="1" step="1" required>
                    <input type="number" class="container input-group-text"
                           name="vencimento"
                           placeholder="vencimento" max="31" min="1" required>

                    <input type="submit" class="container btn btn-dark" value="Criar">

                </form>
            </div>
        </div>
    </div>
</div>