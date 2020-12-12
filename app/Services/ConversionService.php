<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\NumeralConversion;
use App\Repositories\NumeralConversionRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ConversionService implements ConversionServiceInterface
{
    private IntegerConverterInterface $converter;

    private NumeralConversionRepositoryInterface $conversionRepository;

    public function __construct(
        IntegerConverterInterface $converter,
        NumeralConversionRepositoryInterface $conversionRepository
    ) {
        $this->converter = $converter;
        $this->conversionRepository = $conversionRepository;
    }

    public function convert(int $convertFrom): NumeralConversion
    {
        $conversion = $this->converter->convertInteger($convertFrom);

        return $this->conversionRepository->store($convertFrom, $conversion);
    }

    public function getTopTen(): Collection
    {
        return $this->conversionRepository->getTopTen();
    }

    public function getRecent(Carbon $startDate): Collection
    {
        return $this->conversionRepository->getRecent($startDate);
    }
}
