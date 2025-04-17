<?php
require_once __DIR__ . '/src/LcdParser.php';
require_once __DIR__ . '/src/numbers/One.php';
require_once __DIR__ . '/src/numbers/Two.php';
require_once __DIR__ . '/src/numbers/Three.php';
require_once __DIR__ . '/src/numbers/Four.php';
require_once __DIR__ . '/src/numbers/Five.php';
require_once __DIR__ . '/src/numbers/Six.php';
require_once __DIR__ . '/src/numbers/Seven.php';
require_once __DIR__ . '/src/numbers/Eight.php';
require_once __DIR__ . '/src/numbers/Nine.php';

$number = $_POST['number'] ?? '';
$firstLine = '';
$secondLine = '';
$thirdLine = '';

if (ctype_digit($number) && strlen($number) <= 15) {
    $parser = new LcdParser(false); // false = small type
    $parser->numberBuilder($number);
    $firstLine = groupCharacters($parser->getFirstLine());
    $secondLine = groupCharacters($parser->getSecondLine());
    $thirdLine = groupCharacters($parser->getThirdLine());
}

function groupCharacters($string)
{
    $grouped = '';
    for ($i = 0; $i < strlen($string); $i += 3) {
        $group = substr($string, $i, 3);
        $grouped .= "<span class='group'>{$group}</span>";
    }
    return $grouped;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Number To LCD</title>
    <link rel="stylesheet" href="styling.css" />
    <style>
        .group {
            display: inline-block;
            margin: 2px;
            font-family: monospace;
            font-size: 1.5rem;
        }

        .lcd-numbers {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Number To LCD</h1>

    <form method="post" autocomplete="off">
        <input type="text" name="number" id="inputNumber" placeholder="Enter a number" maxlength="15"
            oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
        <button type="submit">Render</button>
    </form>

    <div class="lcd-numbers">
        <div id="grouped-text-one"><?= $firstLine ?></div>
        <div id="grouped-text-two"><?= $secondLine ?></div>
        <div id="grouped-text-three"><?= $thirdLine ?></div>
    </div>
</body>

</html>