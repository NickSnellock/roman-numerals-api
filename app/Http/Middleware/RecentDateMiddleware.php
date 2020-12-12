<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use InvalidArgumentException;

class RecentDateMiddleware
{
    public function handle($request, Closure $next)
    {
        $route = $request->route();

        $validationRules = [
            'startDate' => 'nullable|date_format:Y-m-d',
        ];

        $validator = app('validator')->make($route->parameters(), $validationRules);

        if ($validator->fails()) {
            throw new InvalidArgumentException('Start Date must have the format Y-m-d');
        }

        if (!$route->hasParameter('startDate')) {
            $route->setParameter('startDate', Carbon::now()->subDays(5)->endOfDay());
        } else {
            $route->setParameter(
                'startDate',
                Carbon::createFromFormat(
                    'Y-m-d',
                    $route->parameter('startDate')
                )->endOfDay()
            );
        }

        return $next($request);
    }
}
