<?php

//printf

//$s => string
//$f => float
//$d => integer


$language = 'PHP';

printf("Etude du langage %s<br>",$language);

$arg1="premier";
$arg2="deuxième";

printf("Mon %s et mon %s<br>",$arg1,$arg2);

$num =5;
$location = 'bananier';

echo sprintf('Il y a %d singes dans le %s', $num, $location);