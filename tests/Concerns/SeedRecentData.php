<?php
declare(strict_types=1);

namespace Tests\Concerns;

use Carbon\Carbon;
use Database\Factories\NumeralConversionFactory;

trait SeedRecentData
{
    private Carbon $startDate;

    private array $createdAtDates;

    public function seedRecentData()
    {
        $this->startDate = Carbon::now()->subdays(5)->endOfDay();

        $createdAt = Carbon::now();

        $this->createdAtDates = [];
        for ($i = 0; $i < 10; $i++) {
            if ($createdAt > $this->startDate) {
                $this->createdAtDates[] = $createdAt->format('Y-m-d H:i:s');
            }
            (new NumeralConversionFactory)->create(['created_at' => $createdAt]);
            $createdAt->subDay();
        }
    }
}
