<?php
declare(strict_types=1);

namespace Tests\Concerns;

use Database\Factories\NumeralConversionFactory;

trait SeedTopTenData
{
    private array $topTenNumbers = [23, 42, 96, 954, 1024, 2048, 123, 242, 396, 2954];

    public function seedTopTenData()
    {
        for ($count = 0; $count < 100; $count++) {
            do {
                $randomNumber = rand(1, 3999);
            } while (in_array($randomNumber, $this->topTenNumbers));

            (new NumeralConversionFactory())->create(['convert_from' => $randomNumber]);
        }

        foreach ($this->topTenNumbers as $index => $value) {
            NumeralConversionFactory::times($index + 100)->create(['convert_from' => $value]);
        }
    }
}
