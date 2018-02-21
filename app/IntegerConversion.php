<?php

namespace App;

class IntegerConversion implements IntegerConversionInterface
{
    const ROMAN_NUMBERS = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    ];

    /**
     * convert integer number to roman number
     * @param $integer
     * @return string
     */
    public function toRomanNumerals($integer)
    {
        $romanNumber = '';
        while ($integer > 0) {
            foreach (self::ROMAN_NUMBERS as $roman => $int) {
                if($integer >= $int) {
                    $integer -= $int;
                    $romanNumber .= $roman;
                    break;
                }
            }
        }

        return $romanNumber;
    }

}