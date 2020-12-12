<?php
declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ConvertTest extends TestCase
{
    use DatabaseMigrations;

    public function dataProvider()
    {
        return [
            '1. valid conversion' => [
                'convertThis' => 123,
                'returnCode' => 201,
                'expected' => [
                    'convert_from' => '123',
                    'conversion' => 'CXXIII'
                ]
            ],
            '2. invalid conversion' => [
                'convertThis' => 0,
                'returnCode' => 400,
                'expected' => [
                    'error' => 'Invalid value to convert'
                ]
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testConvert($convertThis, $returnCode, $expected)
    {
        $this->assertDatabaseMissing(
            'numeral_conversion',
           $expected
        );

        $result = $this->post('/api/convert/' . $convertThis);

        $result->assertStatus($returnCode);
        $result->assertJsonFragment($expected);

        if ($returnCode == 201) {
            $this->assertDatabaseHas(
                'numeral_conversion',
                $expected
            );
        }
    }
}
