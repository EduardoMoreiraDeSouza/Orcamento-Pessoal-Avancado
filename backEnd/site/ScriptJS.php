<?php

require_once __DIR__ . "/./Globais.php";

class ScriptJS extends Globais
{
    protected function ScriptJS($script)
    {
        print "<script>$script</script>";
        return true;
    }
}