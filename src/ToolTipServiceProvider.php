<?php

namespace Badinansoft\Tooltip;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Nova;

class ToolTipServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        Nova::script('tooltip', __DIR__.'/../dist/js/tool.js');

        $this->app->booted(static function () {});

        Nova::serving(static function (ServingNova $event) {

            MenuItem::macro('tooltip', function (string $text) {
                if($this->data) {
                    return $this->data([...$this->data, ...['tooltip' => $text]]);
                }
                return $this->data(['tooltip' => $text]);
            });

            Field::macro('tooltip',function (string $text) {
                return $this->withMeta(['tooltip' => $text]);
            });

        });
    }


    public function register(): void
    {
    }
}
