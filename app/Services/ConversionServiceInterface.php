<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\NumeralConversion;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface ConversionServiceInterface
{
    public function convert(int $convertFrom) : NumeralConversion;

    public function getTopTen() : Collection;

    public function getRecent(Carbon $startDate) : Collection;
}
