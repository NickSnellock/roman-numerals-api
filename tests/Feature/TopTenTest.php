<?php
declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Concerns\SeedTopTenData;
use Tests\TestCase;

class TopTenTest extends TestCase
{
    use DatabaseMigrations;
    use SeedTopTenData;

    public function testGetTopTen()
    {
        $this->seedTopTenData();

        $result = $this->get('/api/top-ten');

        $result->assertStatus(200);
        foreach ($this->topTenNumbers as $tenNumber) {
            $result->assertJsonFragment(['convert_from' => "{$tenNumber}"]);
        }
    }
}
