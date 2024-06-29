<?php require_once("./filtros.php"); ?>

<form class="mt-2 position-absolute" method="get">
    <div class="container" style="padding: 0">
        <div class="row">
            <div class="col-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37"
                     fill="currentColor" class="bi bi-calendar-month-fill" viewBox="0 0 16 16">
                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zm.104 7.305L4.9 10.18H3.284l.8-2.375zm9.074 2.297c0-.832-.414-1.36-1.062-1.36-.692 0-1.098.492-1.098 1.36v.253c0 .852.406 1.364 1.098 1.364.671 0 1.062-.516 1.062-1.364z"/>
                    <path d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M2.56 12.332h-.71L3.748 7h.696l1.898 5.332h-.719l-.539-1.602H3.1zm7.29-4.105v4.105h-.668v-.539h-.027c-.145.324-.532.605-1.188.605-.847 0-1.453-.484-1.453-1.425V8.227h.676v2.554c0 .766.441 1.012.98 1.012.59 0 1.004-.371 1.004-1.023V8.227zm1.273 4.41c.075.332.422.636.985.636.648 0 1.07-.378 1.07-1.023v-.605h-.02c-.163.355-.613.648-1.171.648-.957 0-1.64-.672-1.64-1.902v-.34c0-1.207.675-1.887 1.64-1.887.558 0 1.004.293 1.195.64h.02v-.577h.648v4.03c0 1.052-.816 1.579-1.746 1.579-1.043 0-1.574-.516-1.668-1.2z"/>
                </svg>
            </div>

            <div class="col-sm" style="margin-left: -12%; width: 15%;">
                <select class="form-control form-control bg-danger text-light text-center"
                        name="mes_referencia">
                    <option <?= $mesReferencia == 'todos' ? 'selected' : '' ?> value="todos">
                        Todos
                    </option>
                    <option <?= $mesReferencia == '1' ? 'selected' : '' ?> value="1">1 (Jan)
                    </option>
                    <option <?= $mesReferencia == '2' ? 'selected' : '' ?> value="2">2 (Fev)
                    </option>
                    <option <?= $mesReferencia == '3' ? 'selected' : '' ?> value="3">3 (Mar)
                    </option>
                    <option <?= $mesReferencia == '4' ? 'selected' : '' ?> value="4">4 (Abr)
                    </option>
                    <option <?= $mesReferencia == '5' ? 'selected' : '' ?> value="5">5 (Mai)
                    </option>
                    <option <?= $mesReferencia == '6' ? 'selected' : '' ?> value="6">6 (Jun)
                    </option>
                    <option <?= $mesReferencia == '7' ? 'selected' : '' ?> value="7">7 (Jul)
                    </option>
                    <option <?= $mesReferencia == '8' ? 'selected' : '' ?> value="8">8 (Ago)
                    </option>
                    <option <?= $mesReferencia == '9' ? 'selected' : '' ?> value="9">9 (Set)
                    </option>
                    <option <?= $mesReferencia == '10' ? 'selected' : '' ?> value="10">10
                        (Out)
                    </option>
                    <option <?= $mesReferencia == '11' ? 'selected' : '' ?> value="11">11
                        (Nov)
                    </option>
                    <option <?= $mesReferencia == '12' ? 'selected' : '' ?> value="12">12
                        (Dez)
                    </option>
                </select>
            </div>
            <input class="rounded-2 form-control bg-danger text-light" style="width: 20%; margin-left: -2%;"
                   type="text" name="ano_referencia" value="<?= $anoReferencia ?>">

            <div class="col-sm" style="margin-left: -12%;">
                <button type="submit" class="btn btn-danger border-light">Ok</button>
            </div>
        </div>
    </div>
</form>