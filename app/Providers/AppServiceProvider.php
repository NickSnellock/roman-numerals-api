<?php

namespace App\Providers;

use App\Repositories\NumeralConversionRepository;
use App\Repositories\NumeralConversionRepositoryInterface;
use App\Services\ConversionService;
use App\Services\ConversionServiceInterface;
use App\Services\IntegerConverterInterface;
use App\Services\RomanNumeralConverter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConversionServiceInterface::class, ConversionService::class);
        $this->app->bind(IntegerConverterInterface::class, RomanNumeralConverter::class);
        $this->app->bind(NumeralConversionRepositoryInterface::class, NumeralConversionRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
