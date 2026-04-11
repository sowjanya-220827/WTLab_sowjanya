<?php
$globalVar = 'I am global';

echo '<h2>PHP Variable Scope Demo</h2>';

echo '<h3>1) Global vs Local</h3>';
function showScope() {
    $localVar = 'I am local';
    global $globalVar;
    static $count = 0;
    $count++;

    echo "Local: $localVar<br>";
    echo "Global: $globalVar<br>";
    echo "Static counter: $count<br><br>";
}

showScope();
showScope();

echo '<h3>2) Outside Function</h3>';
echo "Global outside: $globalVar<br>";
?>
