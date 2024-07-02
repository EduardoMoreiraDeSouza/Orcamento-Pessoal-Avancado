<div class="col-auto">
        <a class="btn btn-dark btn-sm" type="button" data-bs-toggle="collapse"
                data-bs-target="#novoBancoCorretora" aria-expanded="false"
                aria-controls="collapseWidthExample">
            Novo Banco/Corretora
        </a>

    <div style="min-height: auto;" class="mb-4 mt-1">
        <div class="collapse collapse-horizontal" id="novoBancoCorretora">
            <div class="card card-body border border-dark bg-secondary"
                 style="width: 80%;">
                <form action="../backEnd/InteracaoFront/novoBancoCorretora.php"
                      method="POST"
                      class="form hstack gap-3">

                    <input type="text" class="container input-group-text" name="bancoCorretora"
                           placeholder="Nome:"
                           required>
                    <input type="text" class="container input-group-text" name="saldo"
                           placeholder="Saldo:" step="0.01">

                    <input type="submit" class="container btn btn-dark" value="Criar">

                </form>
            </div>
        </div>
    </div>

</div>