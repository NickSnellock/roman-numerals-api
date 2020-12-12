<?php
declare(strict_types=1);

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\RecentDateMiddleware;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Mockery;
use Tests\TestCase;

class RecentDateMiddlewareTest extends TestCase
{
    public function dataProvider()
    {
        return [
            '1. No date provided' => [
                'startDate' => null,
                'expected' => Carbon::now()->endOfDay(),
            ],
            '2. Valid date provided' => [
                'startDate' => '2020-12-12',
                'expected' => Carbon::createFromFormat('Y-m-d', '2020-12-12')->endOfDay(),
            ],
            '3. Invalid date provided' => [
                'startDate' => 'abc',
                'expected' => 'Exception',
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testHandle($startDate, $expected)
    {
        $route = Mockery::spy(Route::class);
        if ($startDate === null) {
            $route->shouldReceive('parameters')->andReturn([]);
            $route->shouldReceive('hasParameter')->andReturn(false);
        } else {
            $route->shouldReceive('parameters')->andReturn(['startDate' => $startDate]);
            $route->shouldReceive('hasParameter')->andReturn(true);
            $route->shouldReceive('parameter')->andReturn($startDate);
        }
        $route->shouldReceive('setParameter');

        $request = Mockery::mock(Request::class);
        $request->shouldReceive('route')->andReturn($route);

        $recentDateMiddleware = app(RecentDateMiddleware::class);

        $next = function ($request) {return $request;};

        if ($expected == 'Exception') {
            $this->expectException(\InvalidArgumentException::class);
        }

        $recentDateMiddleware->handle($request, $next);
    }
}
