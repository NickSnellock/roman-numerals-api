<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\NumeralConversion;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface NumeralConversionRepositoryInterface
{
    public function store(int $convertFrom, string $convertedTo): NumeralConversion;

    public function getTopTen() : Collection;

    public function getRecent(Carbon $startDate) : Collection;
}
