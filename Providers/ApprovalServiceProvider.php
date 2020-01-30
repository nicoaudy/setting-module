<?php

namespace Modules\Setting\Providers;

use Modules\Setting\Services\Approval;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ApprovalServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        AliasLoader::getInstance()->alias('Approval', Approval::class);

        $this->app->bind('approval', function () {
            return new Approval();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
