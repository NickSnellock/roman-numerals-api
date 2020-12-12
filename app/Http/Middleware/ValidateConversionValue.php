<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\InvalidConversionValue;
use Closure;

class ValidateConversionValue
{
    public function handle($request, Closure $next)
    {
        $route = $request->route();

        $validationRules = [
            'convertThis' => 'required|integer|between:1,3999',
        ];

        $validator = app('validator')->make($route->parameters(), $validationRules);

        if ($validator->fails()) {
            throw new InvalidConversionValue();
        }
        return $next($request);
    }
}
