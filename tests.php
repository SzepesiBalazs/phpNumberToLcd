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

$parser = new LcdParser(false); // false = small type, size is ignored
$output = $parser->numberBuilder(1);

echo "LCD Output for 1:\n";
echo $output;