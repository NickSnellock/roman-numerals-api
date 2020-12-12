<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\NumeralConversion;
use App\Services\IntegerConverterInterface;
use Illuminate\Database\Eloquent\Factories\Factory;

class NumeralConversionFactory extends Factory
{
    protected $model = NumeralConversion::class;

    public function definition()
    {
        $convertFrom = $this->faker->numberBetween(1, 3999);
        /** @var IntegerConverterInterface $conversion */
        $conversion = app(IntegerConverterInterface::class)->convertInteger($convertFrom);

        return [
            'convert_from' => $convertFrom,
            'conversion' => $conversion,
            'created_at' => now(),
        ];
    }
}
