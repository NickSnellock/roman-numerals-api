<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumeralConversion extends Model
{
    use HasFactory;

    protected $table = 'numeral_conversion';

    protected $fillable = [
        'convert_from',
        'conversion',
    ];

    protected $visible = [
        'convert_from',
        'conversion',
        'created_at',
    ];

    protected $dates = [
        'created_at',
    ];

    public function __construct(array $attributes = [])
    {
        $this->timestamps = false;

        parent::__construct($attributes);
    }
}
