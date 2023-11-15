<?php

namespace App\Nova;

use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Coin extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Coin::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Number::make('Max Supply', 'maxSupply')->min(1)->max(1000000000)->step(0.000001),
            Number::make('Reserved Supply', 'reservedSupply')->min(1)->max(1000000000)->step(0.000001),
            Number::make('Available Supply', 'availableSupply')->min(1)->max(1000000000)->step(0.000001),
            Number::make('Circulating Supply', 'circulatingSupply')->min(1)->max(1000000000)->step(0.000001),
            Number::make('Market Cap', 'marketCap')->min(1)->max(1000000000)->step(0.000001),
            Number::make('Current Price', 'currentPrice')->min(1)->max(1000000000)->step(0.000001),
            Number::make('Initial Price', 'initialPrice')->min(1)->max(1000000000)->step(0.000001),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
