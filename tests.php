<?php

require_once __DIR__ . '../src/LcdParser.php';
require_once __DIR__ . '../src/numbers/One.php';
require_once __DIR__ . '../src/numbers/Two.php';
require_once __DIR__ . '../src/numbers/Three.php';
require_once __DIR__ . '../src/numbers/Four.php';
require_once __DIR__ . '../src/numbers/Five.php';
require_once __DIR__ . '../src/numbers/Six.php';
require_once __DIR__ . '../src/numbers/Seven.php';
require_once __DIR__ . '../src/numbers/Eight.php';
require_once __DIR__ . '../src/numbers/Nine.php';


$parser = new LcdParser(false); 
$parser->numberBuilder(123); 

echo $parser->getFirstLine() . "\n";
echo $parser->getSecondLine() . "\n";
echo $parser->getThirdLine() . "\n";