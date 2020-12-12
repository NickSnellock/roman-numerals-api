<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NumeralConversion;
use App\Http\Resources\NumeralConversionCollection;
use App\Services\ConversionServiceInterface;
use Carbon\Carbon;

class NumeralConversionController extends Controller
{
    private ConversionServiceInterface $conversionService;

    public function __construct(
        ConversionServiceInterface $conversionService
    )
    {
        $this->conversionService = $conversionService;
    }

    public function convertNumber(int $convertThis)
    {
        $numeralConversion = $this->conversionService->convert($convertThis);

        return (new NumeralConversion($numeralConversion))->response();
    }

    public function getTopTen()
    {
        $topTen = $this->conversionService->getTopTen();
        return (new NumeralConversionCollection($topTen))->response();
    }

    public function getRecent(Carbon $startDate)
    {
        $recent = $this->conversionService->getRecent($startDate);

        return (new NumeralConversionCollection($recent))->response();
    }
}
