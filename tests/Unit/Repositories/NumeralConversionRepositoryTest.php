<?php
declare(strict_types=1);

namespace Tests\Unit\Repositories;

use App\Repositories\NumeralConversionRepositoryInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Concerns\SeedRecentData;
use Tests\Concerns\SeedTopTenData;
use Tests\TestCase;

class NumeralConversionRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    use SeedRecentData;
    use SeedTopTenData;

    public function testStore()
    {
        $this->assertDatabaseMissing(
            'numeral_conversion',
            [
                'convert_from' => 123,
                'conversion' => 'Conversion',
            ]
        );

        /** @var NumeralConversionRepositoryInterface $repository */
        $repository = app(NumeralConversionRepositoryInterface::class);

        $repository->store(123, 'Conversion');

        $this->assertDatabaseHas(
            'numeral_conversion',
            [
                'convert_from' => 123,
                'conversion' => 'Conversion',
            ]
        );
    }

    public function testGetTopTen()
    {
        $this->seedTopTenData();

        $repository = app(NumeralConversionRepositoryInterface::class);

        $topTen = $repository->getTopTen();

        $index = 9;

        $topTen->each(function ($conversion, $key) use (&$index) {
            $this->assertEquals($this->topTenNumbers[$index], $conversion['convert_from']);
            $index--;
        });
    }

    public function testGetRecent()
    {
        $this->seedRecentData();

        /** @var NumeralConversionRepositoryInterface $repository */
        $repository = app(NumeralConversionRepositoryInterface::class);

        $recent = $repository->getRecent($this->startDate);

        $this->assertEquals(5, $recent->count());

        $recent->each(function ($conversion) {
            $this->assertGreaterThan($this->startDate, $conversion->created_at);
        });
    }
}
