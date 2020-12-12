<?php
declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Repositories\NumeralConversionRepositoryInterface;
use App\Services\ConversionServiceInterface;
use App\Services\IntegerConverterInterface;
use Database\Factories\NumeralConversionFactory;
use Mockery;
use Tests\TestCase;

class ConversionServiceTest extends TestCase
{
    public function testConvertSuccess()
    {
        $numeralConversion = (new NumeralConversionFactory())->make(
            [
                'convertFrom' => 123,
                'conversion' => 'convertInteger',
            ]
        );

        $converter = Mockery::spy(IntegerConverterInterface::class);
        $converter->shouldReceive('convertInteger')
            ->andReturn('converted');
        $conversionRepository = Mockery::spy(NumeralConversionRepositoryInterface::class);
        $conversionRepository->shouldReceive('store')->andReturn($numeralConversion);

        app()->instance(IntegerConverterInterface::class, $converter);
        app()->instance(NumeralConversionRepositoryInterface::class, $conversionRepository);

        $conversionService = app(ConversionServiceInterface::class);

        $result = $conversionService->convert(123);

        $this->assertEquals($result, $numeralConversion);
    }
}
