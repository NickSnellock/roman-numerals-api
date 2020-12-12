<?php
declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Concerns\SeedRecentData;
use Tests\TestCase;

class RecentTest extends TestCase
{
    use DatabaseMigrations;
    use SeedRecentData;

    public function testGetRecent()
    {
        $this->seedRecentData();

        $result = $this->get('/api/recent/' . $this->startDate->format('Y-m-d'));

        $result->assertStatus(200);
        foreach ($this->createdAtDates as $createdAtDate) {
            $result->assertJsonFragment(['created_at' => $createdAtDate]);
        }
    }
}
