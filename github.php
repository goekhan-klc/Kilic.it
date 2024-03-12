<?php 
exec("git pull https://goekhan.klc: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@github.com/goekhan-klc/space4_kilicit master", $out);
foreach ($out as $line) {
    echo $line . "\n";
}
?>
