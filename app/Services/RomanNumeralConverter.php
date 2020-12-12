<?php
declare(strict_types=1);

namespace App\Services;

class RomanNumeralConverter implements IntegerConverterInterface
{
    private array $numbers = [
        1,
        4,
        5,
        9,
        10,
        40,
        50,
        90,
        100,
        400,
        500,
        900,
        1000,
    ];

    private array $symbols = [
        'I',
        'IV',
        'V',
        'IX',
        'X',
        'XL',
        'L',
        'XC',
        'C',
        'CD',
        'D',
        'CM',
        'M',
    ];

    public function convertInteger(int $integer): string
    {
        $conversion = '';
        $index = count($this->numbers) - 1;

        while ($integer > 0) {
            $number = $this->numbers[$index];
            $divisor = (int)($integer/$number);
            $integer = $integer % $number;
            for ($count = $divisor; $count > 0; $count--) {
                $conversion .= $this->symbols[$index];
            }
            $index--;
        }

        return $conversion;
    }
}
