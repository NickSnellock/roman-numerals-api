<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\NumeralConversion;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class NumeralConversionRepository implements NumeralConversionRepositoryInterface
{

    public function store(int $convertFrom, string $convertedTo): NumeralConversion
    {
        $conversion = NumeralConversion::create([
            'convert_from' => $convertFrom,
            'conversion' => $convertedTo,
        ]);

        $conversion->save();

        $conversion->refresh();

        return $conversion;
    }

    public function getTopTen(): Collection
    {
        $counts = DB::select(
            DB::raw(
                'SELECT convert_from, conversion, count(*) AS frequency
FROM numeral_conversion
GROUP BY convert_from
ORDER BY frequency DESC
LIMIT 10'
            )->getValue()
        );

        array_walk($counts, function (&$conversion) {
            $conversion = json_decode(json_encode($conversion), true);
        });

        return collect($counts);
    }

    public function getRecent(Carbon $startDate): Collection
    {
        $recent = NumeralConversion::where('created_at', '>', $startDate)->get();

        return $recent;
    }
}
