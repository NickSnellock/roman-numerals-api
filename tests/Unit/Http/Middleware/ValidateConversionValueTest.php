<?php
declare(strict_types=1);

namespace Tests\Unit\Http\Middleware;

use App\Exceptions\InvalidConversionValue;
use App\Http\Middleware\ValidateConversionValue;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Mockery;
use Tests\TestCase;

class ValidateConversionValueTest extends TestCase
{
    public function dataProvider()
    {
        return [
            '1. Value missing' => [
                'convertThis' => null,
                'expected' => 'Exception',
            ],
            '2. Lowest Invalid value' => [
                'convertThis' => 0,
                'expected' => 'Exception',
            ],
            '3. Lowest valid value' => [
                'convertThis' => 1,
                'expected' => 'No Exception',
            ],
            '4. Highes valid value' => [
                'convertThis' => 3999,
                'expected' => 'No Exception',
            ],
            '5. First High Invalid value' => [
                'convertThis' => 4000,
                'expected' => 'Exception',
            ],
            '6. Invalid (non-integer) Value' => [
                'convertThis' => 'abc',
                'expected' => 'Exception',
            ]
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testHandle($convertThis, $expected)
    {
        $route = Mockery::spy(Route::class);
        if ($convertThis === null) {
            $route->shouldReceive('parameters')->andReturn([]);
        } else {
            $route->shouldReceive('parameters')->andReturn(['convertThis' => $convertThis]);
        }

        $request = Mockery::mock(Request::class);
        $request->shouldReceive('route')->andReturn($route);

        $validateConversionValue = app(ValidateConversionValue::class);

        if ($expected == 'Exception') {
            $this->expectException(InvalidConversionValue::class);
        }

        $next = function ($request) {return $request;};

        $validateConversionValue->handle($request, $next);
    }
}
