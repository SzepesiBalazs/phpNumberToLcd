<?php

require_once __DIR__ . '/numbers/One.php';
require_once __DIR__ . '/numbers/Two.php';
require_once __DIR__ . '/numbers/Three.php';
require_once __DIR__ . '/numbers/Four.php';
require_once __DIR__ . '/numbers/Five.php';
require_once __DIR__ . '/numbers/Six.php';
require_once __DIR__ . '/numbers/Seven.php';
require_once __DIR__ . '/numbers/Eight.php';
require_once __DIR__ . '/numbers/Nine.php';

class LcdParser
{
    private $firstLine;
    private $secondLine;
    private $thirdLine;
    private $additionalLineOne;
    private $additionalLineTwo;
    private $isLargeType;
    private $largeSizeArray;
    private $size;

    public function __construct($isLargeType = false, $size = 0)
    {
        $this->firstLine = "";
        $this->secondLine = "";
        $this->thirdLine = "";
        $this->additionalLineOne = "";
        $this->additionalLineTwo = "";
        $this->isLargeType = $isLargeType;
        $this->largeSizeArray = array_fill(0, 5, "");
        $this->size = $size;
    }
    public function numberBuilder($inputNumber)
    {
        $numberArray = str_split((string) $inputNumber);

        $this->firstLine = "";
        $this->secondLine = "";
        $this->thirdLine = "";

        foreach ($numberArray as $digit) {
            $n = intval($digit);
            $source = $this->numberSource();

            if ($this->isLargeType) {
                $firstLineArray = $source[$n]->getFirstArray();
                $secondLineArray = $source[$n]->getSecondArray();
                $thirdLineArray = $source[$n]->getThirdArray();

                $additionalLineOne = $secondLineArray;
                $additionalLineOne[1] = " ";
                $additionalLineTwo = $thirdLineArray;
                $additionalLineTwo[1] = " ";

                $firstLineArray = $this->arrayTransformer($firstLineArray);
                $secondLineArray = $this->arrayTransformer($secondLineArray);
                $thirdLineArray = $this->arrayTransformer($thirdLineArray);
                $additionalLineOne = $this->arrayTransformer($additionalLineOne);
                $additionalLineTwo = $this->arrayTransformer($additionalLineTwo);

                $this->largeSizeArray[0] .= implode("", $firstLineArray);
                $this->largeSizeArray[1] .= implode("", $additionalLineOne);
                $this->largeSizeArray[2] .= implode("", $secondLineArray);
                $this->largeSizeArray[3] .= implode("", $additionalLineTwo);
                $this->largeSizeArray[4] .= implode("", $thirdLineArray);
            } else {
                $this->firstLine .= implode("", $source[$n]->getFirstArray());
                $this->secondLine .= implode("", $source[$n]->getSecondArray());
                $this->thirdLine .= implode("", $source[$n]->getThirdArray());
            }
        }

        for ($i = 2; $i < $this->size; $i++) {
            array_splice($this->largeSizeArray, 1, 0, [$this->largeSizeArray[1]]);
            array_splice($this->largeSizeArray, count($this->largeSizeArray) - 2, 0, [$this->largeSizeArray[count($this->largeSizeArray) - 2]]);
        }

        foreach ($this->largeSizeArray as &$line) {
            $line = substr($line, 9) . "\n";
        }

        return implode("", $this->largeSizeArray);
    }

    private function arrayTransformer($lineArray)
    {
        for ($i = 1; $i < $this->size; $i++) {
            array_splice($lineArray, 1, 0, [$lineArray[1]]);
        }
        return $lineArray;
    }

    public function getFirstLine()
    {
        return $this->firstLine;
    }

    public function getSecondLine()
    {
        return $this->secondLine;
    }

    public function getThirdLine()
    {
        return $this->thirdLine;
    }

    public function getAdditionalLineOne()
    {
        return $this->additionalLineOne . "\n";
    }

    public function getAdditionalLineTwo()
    {
        return $this->additionalLineTwo . "\n";
    }

    private function numberSource()
    {
        return [
            1 => new One(),
            2 => new Two(),
            3 => new Three(),
            4 => new Four(),
            5 => new Five(),
            6 => new Six(),
            7 => new Seven(),
            8 => new Eight(),
            9 => new Nine(),
        ];
    }
}
