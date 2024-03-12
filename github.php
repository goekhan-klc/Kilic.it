<?php 
exec("git pull", $out);
foreach ($out as $line) {
    echo $line . "\n";
}
?>